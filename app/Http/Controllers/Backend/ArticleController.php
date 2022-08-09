<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ArticleDataTable;
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
    public function index(ArticleDataTable $datatable)
    {
        return $datatable->render($this->path . 'index');

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
        return redirect()->route("backend.article-view")->with("success", "Article created successfully.");
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
        return redirect()->route("backend.article-view")->with("success", "Article deleted successfully.");
    }



    public function updateTaskStatus(Article $article, $taskStatus)
    {
        $user = auth()->user();
        if ($user->id == $article->writer_id && $article->task_status == "writing" && $taskStatus == "open") {
            $article->update([
                "task_status" => $taskStatus,
            ]);
            return redirect()->route("backend.article-view")->with("success", "Article Task status updated successfully.");
        } else if (in_array($user->role->title, ["Editor", "Super Admin"]) && $article->task_status == "open" && $taskStatus == "reviewing") {
            $article->update([
                "task_status" => $taskStatus,
                "editor_id" => $user->id,
            ]);
            return redirect()->route("backend.article-view")->with("success", "Article Task status updated successfully.");
        } else if ($user->id == $article->editor_id && in_array($user->role->title, ["Editor", "Super Admin"])  && $article->task_status == "reviewing" && $taskStatus == "published") {
            $article->update([
                "task_status" => $taskStatus,
            ]);
            return redirect()->route("backend.article-view")->with("success", "Article Task status updated successfully.");
        } else {
            return redirect()->back()->with("error", "You are not authorized to perform this action.");
        }
    }



    public function updateStatus(Article $article)
    {
        if ($article && $article->id) {
            $article->status = !$article->status;
            $article->save();
            return redirect()->route("backend.article-view")->with("success", "Article status updated successfully.");
        }
        return redirect()->route("backend.article-view")->with("error", "Article not found.");
    }
}
