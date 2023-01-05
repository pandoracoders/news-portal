<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CategoryRequest;
use App\Models\Backend\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $path = "backend.pages.category.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->path . "index", [
            "categories" => Category::orderBy("id", "desc")->get()
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
            'parentCategories' => Category::whereNull('parent_id')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route("backend.category-view")->with("success", "Category created successfully.");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view($this->path . "crud", [
            "category" => $category,
            'parentCategories' => Category::where('id','!=',$category->id)->whereNull('parent_id')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // dd($request->validated());
        $category->update($request->validated());
        return redirect()->route("backend.category-view")->with("success", "Category updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category?->delete();
        return redirect()->route("backend.category-view")->with("success", "Category deleted successfully.");
    }



    public function updateStatus(Category $category)
    {
        if ($category && $category->id) {
            $category->status = !$category->status;
            $category->save();
            return redirect()->route("backend.category-view")->with("success", "Category status updated successfully.");
        }
        return redirect()->route("backend.category-view")->with("error", "Category not found.");
    }
}
