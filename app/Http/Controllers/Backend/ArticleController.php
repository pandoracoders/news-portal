<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ArticleRequest;
use App\Models\Backend\Article;
use App\Services\ImageUpload;

class ArticleController extends Controller
{
    private $path = "backend.pages.article.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->path . "index", [
            "articles" => Article::orderBy("id", "desc")->get()
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
            "categories" => \App\Models\Backend\Category::all(),
            "tags" => \App\Models\Backend\Tag::all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        Article::create($request->validated());
        return redirect()->route("backend.article-list")->with("success", "Article created successfully.");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        // dd("hi");
        return view($this->path . "crud", [
            "article" => $article,
            "categories" => \App\Models\Backend\Category::all(),
            "tags" => \App\Models\Backend\Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {

        // dd($request->validated());

        if ($request->hasFile("image")) {
            $articleArray = array_merge(
                collect($request->validated())->except(["tags"])->toArray(),
                [
                    "image" => ImageUpload::upload($request->image),
                ]
            );
        } else {
            $articleArray =
                collect($request->validated())->except(["tags"])->toArray();
        }

        $article->update($articleArray);

        $article->tags()->sync($request->tags);


        return redirect()->back()->with("success", "Article updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article?->delete();
        return redirect()->route("backend.article-list")->with("success", "Article deleted successfully.");
    }
}
