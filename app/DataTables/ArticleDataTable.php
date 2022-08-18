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

    private $writer_hide_condition = [
        "published",
        "editing",
        "submitted",
    ];

    private $editor_hide_condition = [
        "modifying",
    ];

    public function __construct()
    {
        $this->user = auth()->user();
        $this->role = $this->user->role->slug;
        $this->showAction = $this->showAction();
    }

    /**
     * Build DataTable class.
     *
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
                    $td .= "<span> Published:</span> <span> <b> " . carbon($row->published_at)->format("M d,Y H:m") . " </b> </span><br/>";
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
        $model = $model->orderBy("published_at")->newQuery();

        if (request("task_status")) {
            $model->where("task_status", request("task_status"));
        }

        if ($this->role == "writer") {
            $model->where("writer_id", $this->user->id);
        } elseif ($this->role == "editor") {
            $model->where("editor_id", $this->user->id)
                ->orWhereNull("editor_id");
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

                if ($row->task_status == "writing") {
                    $td .= "<a href='" . route('backend.article-update_task_status', ["article" => $row, "taskStatus" => "submitted"]) . "'
        class='badge badge-success badge-sm'> <i class='bi bi-check-circle'></i>Post for review</a>";
                }
            }

            // } else {
            // }
        } else if ($this->role == "editor") {

            if (!in_array($row->task_status, $this->editor_hide_condition)) {
                if ($row->task_status == "submitted" || in_array($row->task_status, ["editing", "published"])) {
                    $td = "<a href='" . route('backend.article-edit', $row) . "'
                    class='badge badge-success badge-sm mr-2'> <i class='bi bi-pencil-square'></i> Edit</a>";
                }
            }
        } else if ($this->role == "super-admin") {
            $td = "<a href='" . route('backend.article-edit', $row) . "'
                    class='badge badge-success badge-sm mr-2'> <i class='bi bi-pencil-square'></i> Edit</a>";
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
