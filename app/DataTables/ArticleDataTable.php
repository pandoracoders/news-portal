<?php

namespace App\DataTables;

use App\Models\Backend\Article;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ArticleDataTable extends DataTable
{

    private $role;
    private $user;

    private $showAction = true;

    private $showLinks = false;

    private $writer_hide_condition = [
        "published",
        "editing",
        "submitted",
        "autopublish"
    ];

    private $editor_hide_condition = [
        "modifying",
        "autopublish"
    ];

    public function __construct()
    {
        $this->user = auth()->user();
        $this->role = $this->user->role->slug;
        $this->showAction = $this->showAction();
        $this->showLinks = (request("task_status") == "published" || !request("task_status")) ? true : false;
    }

    /**
     * Build DataTable class.
     *0
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        $rawColumns = [
            "Active Status",
            "task_status",
            "title",
            "info",
        ];

        $datatable = (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn("title", function ($row) {
                return (str_word_count($row->title) > 5 ? implode(' ', array_slice(str_word_count($row->title, 2), 0, 5)) . "..." : $row->title)
                    . "</span>";
            })
            ->addColumn("info", function ($row) {
                $td = "";
                if ($this->user->id != $row->writer_id) {
                    $td .= "<span> Writer:</span> <span> <b> {$row->writer?->name} </b> </span><br/>";
                }
                if ($this->user->id != $row->editor_id) {
                    $td .= "<span> Editor:</span> <span> <b> {$row->editor?->name} </b> </span><br/>";
                }
                if ($row->task_status == "published") {
                    $td .= "<span> Published:</span> <span> <b> " . carbon($row->published_at). " </b> </span><br/>";
                }

                return $td;
            })
            ->addColumn("Active Status", function ($article) {
                // dd($this->role);
                if ($this->role == "writer") {
                    return "<span class='badge badge-sm btn-" . ($article->status ? 'success' : 'danger') . "'>" . ($article->status ? "Active" : "Inactive") . "</span>";
                } else {
                    return "<a href='" . route("backend.article-update_status", $article) . "' class='badge badge-sm btn-" . ($article->status ? 'success' : 'danger') . "'>" . ($article->status ? "Active" : "Inactive") . "</a>";
                }
            })
            ->addColumn("task_status", function ($row) {
                $class = in_array($row->task_status, ["rejected"]) ? "badge badge-sm btn-warning" : (in_array($row->task_status, ["published"]) ? "badge badge-sm btn-success" : 'badge badge-sm btn-info');
                return "<span class='$class text-white text-capitalize'>" . $row->task_status . "</span>";
            })
            ->setRowId('id');
        if (request()->task_status == "published") {
            $datatable->addColumn("views", function ($row) {
                // return "";
                return "<span> <i class='bi bi-eye'></i> $row->views </span>";
            });
            array_push($rawColumns, "views");
        }

        if ($this->showAction) {
            $datatable->addColumn("action", function ($row) {
                return $this->getAction($row);
            });
            array_push($rawColumns, "action");
        }

        if ($this->showLinks) {
            $datatable->addColumn('incoming', function ($row) {
                return $row->incoming_link;
            });
            $datatable->addColumn("outgoing", function ($row) {
                return $row->outgoing_link;
            });
        }

        if (in_array($this->role, ["super-admin", "editor"]) && $this->showLinks) {
            $datatable->addColumn("featured", function ($row) {

                return $row->task_status == 'published' ? "<input type='checkbox' class='reactive' " . ($row->is_featured ? 'checked' : '') . " data-url='" . route("backend.article-featured", ["article" => $row]) . "'/>" : '';
            });

            $datatable->addColumn("editor_choice", function ($row) {
                return $row->task_status == 'published' ? "<input type='checkbox' class='reactive' " . ($row->editor_choice ? 'checked' : '') . " data-url='" . route("backend.article-editor_choice", ["article" => $row]) . "'/>" : '';
            });

            array_push($rawColumns, "featured");
            array_push($rawColumns, "editor_choice");
        }

        return $datatable->rawColumns($rawColumns);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Article $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Article $model): QueryBuilder
    {
        $model = $model->newQuery();

        if (request("task_status")) {
             $model->where("task_status", request("task_status"));
        }

        if ($this->role == "writer") {
            $model->where("writer_id", $this->user->id);
        } elseif ($this->role == "editor") {
            if(request("task_status") == "submitted"){
                $model->where("task_status","submitted");
            }elseif(request("task_status")==""){
                $model->where("editor_id", $this->user->id)->orWhere("task_status","submitted");
            }
            else{
                $model->where("editor_id", $this->user->id);
            }
        }

        if ((request()->search['value'] )) {
            if ($this->role != "writer") {
                $model->where('title', 'like', "%" . request()->search['value'] . "%")->orWhere('body','like','%'.request()->search['value'].'%');
            }
        }

        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('article-table')
            ->columns($this->getColumns())
            ->minifiedAjax();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        $columns = [
            Column::computed('id')
                ->width(20),
            Column::make("title")->width(200),
            Column::make("info")->width(120),
            Column::make("Active Status")->width(60)->class("text-center"),
            Column::make("task_status")->width(60)->class("text-center"),
            // Column::make('add your columns'),
        ];
        if (request()->task_status == "published") {
            array_push($columns, Column::make("views")->width(60)->class("text-center"));
        }
        if ($this->showAction) {
            array_push($columns, Column::make("action"));
        }

        if (in_array($this->role, ["super-admin", "editor"]) && $this->showLinks) {
            array_push($columns, Column::make("featured"));
            array_push($columns, Column::make("editor_choice"));
        }

        if ($this->showLinks) {
            array_push($columns, Column::make("incoming")
                ->title('<i class="bi bi-box-arrow-in-down-left" style="font-size:20px"></i>')
                ->data("incoming")
                ->class("text-center")
                ->width(100)

                ->class("text-center"));
            array_push($columns, Column::make("outgoing")
                ->title('<i class="bi bi-box-arrow-up-right" style="font-size:18px"></i>')
                ->data("outgoing")
                ->width(60)
                ->class("text-center"));
        }



        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Article_' . date('YmdHis');
    }

    public function getAction($row)
    {
        $td = "";
        if ($this->role == "writer") {
            // if (in_array($row->task_status, ["writing", "rejected"])) {\
            if (!in_array($row->task_status, $this->writer_hide_condition)) {
                $td = "<a href='" . route('backend.article-edit', $row) . "'
                class='badge badge-success badge-sm mr-2'> <i class='bi bi-pencil-square'></i> Edit</a>";
            }
        } else if ($this->role == "editor") {

            if (!in_array($row->task_status, $this->editor_hide_condition)) {
                if ($row->task_status == "submitted" || in_array($row->task_status, ["editing", "published"])) {
                    $td = "<a href='" . route('backend.article-edit', $row) . "'
                    class='badge badge-success badge-sm mr-2'> <i class='bi bi-pencil-square'></i> Edit</a>";
                }
            }
        } else if ($this->role == "super-admin" ) {
           if( $row->task_status == 'published' || $row->task_status == 'submitted' || $this->user->id == $row->writer_id || $this->user->id == $row->editor_id){
            $td = "<a href='" . route('backend.article-edit', $row) . "'
            class='badge badge-success badge-sm mr-2'> <i class='bi bi-pencil-square'></i> Edit</a>";
           }
        }
        return $td;
    }

    private function showAction()
    {
        if ($this->role == "writer") {
            $hide_condition = $this->writer_hide_condition;
        } else if ($this->role == "editor") {
            $hide_condition = $this->editor_hide_condition;
        } else {
            $hide_condition = [];
        }

        if (in_array(request("task_status", ''), $hide_condition)) {
            return false;
        }
        return true;
    }
}
