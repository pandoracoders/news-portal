<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TableSetRequest;
use App\Models\Backend\Category;
use App\Models\Backend\TableSet;
use Illuminate\Http\Request;

class TableSetController extends Controller
{
    private $path = "backend.pages.table_set.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->path . "index", [
            "categories" => TableSet::orderBy("id", "desc")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path . "crud", [
            "categories" => Category::all()

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TableSetRequest $request)
    {

        $table_set = TableSet::create($request->validated());
        foreach ($request->categories as $category) {
            $table_set->tableSetCategories()->create([
                "category_id" => $category
            ]);
        }
        foreach ($request->table_fields as $field) {
            $table_set->tableFields()->create($field);
        }
        return redirect()->route("backend.table_set-index")->with("success", "TableSet created successfully.");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TableSet $table_set)
    {
        return view($this->path . "crud", [
            "table_set" => $table_set,
            "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TableSetRequest $request, TableSet $table_set)
    {
        $table_set->update($request->validated());
        return redirect()->route("backend.table_set-index")->with("success", "TableSet updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TableSet $table_set)
    {
        $table_set?->delete();
        return redirect()->route("backend.table_set-index")->with("success", "TableSet deleted successfully.");
    }
}
