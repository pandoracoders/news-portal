<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ArticleTitleRequest;
use App\Imports\Backend\ArticleTitle as BackendArticleTitle;
use App\Jobs\Backend\ArticleLogJob;
use App\Models\Backend\Article;
use App\Models\Backend\ArticleTitle;
use App\Models\Backend\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleTitleController extends Controller
{
    private $path = "backend.pages.article_title.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->title == "Writer") {
            $article_title = ArticleTitle::whereNull("article_id")->orderBy("created_at", "desc")->get();
        } else {
            $article_title = ArticleTitle::orderBy("created_at", "desc")->get();
        }
        return view($this->path . "index", [
            "article_titles" => $article_title
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
        ]);
    }


    public function create_and_publish(){
        return view($this->path . "create_and_publish", [
            "categories" => \App\Models\Backend\Category::all(),
        ]);
    }

    public function start_writing( Request $request){
        $article = Article::create([
            "title" => $request->title,
            "slug" => Str::slug($request->title),
            "task_status" => 'autopublish',
            "category_id" => $request->category_id ?? 1, // TODO remove default 1
            "writer_id" => auth()->user()->id,
        ]);


        ArticleLogJob::dispatchAfterResponse($article, "Article writing by " . auth()->user()->name);

        return redirect()->route("backend.article-edit", ["article" => $article]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleTitleRequest $request)
    {
        ArticleTitle::create($request->validated());
        return redirect()->route("backend.article_title-view")->with("success", "ArticleTitle created successfully.");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ArticleTitle $article_title)
    {
        return view($this->path . "crud", [
            "article_title" => $article_title,
            "categories" => \App\Models\Backend\Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleTitleRequest $request, ArticleTitle $article_title)
    {
        $article_title->update($request->validated());
        return redirect()->route("backend.article_title-view")->with("success", "ArticleTitle updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleTitle $article_title)
    {
        $article_title?->delete();
        return redirect()->route("backend.article_title-view")->with("success", "ArticleTitle deleted successfully.");
    }



    public function pick(ArticleTitle $article_title)
    {
        if (auth()->user()->allArticles()->where("task_status", "writing")->count() > 2) {
            return redirect()->route("backend.article_title-view")->with("error", "You can't pick more than 2 articles.");
        }
        $article = Article::create([
            "title" => $article_title->title,
            "slug" => Str::slug($article_title->title),
            "category_id" => $article_title->category_id ?? 1, // TODO remove default 1
            "writer_id" => auth()->user()->id,
        ]);

        $article_title->update([
            "article_id" => $article->id,
        ]);


        ArticleLogJob::dispatchAfterResponse($article, "Article picked by " . auth()->user()->name);

        return redirect()->route("backend.article-edit", ["article" => $article]);
    }



    public function import(Request $request)
    {

        $article_titles = [];
        $count = 0;
        if (($open = fopen(public_path(("title.csv")), "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                if ($count > 0) {
                    $category_id = Category::where("slug", $data[1])->first()->id ?? null;
                    ArticleTitle::create([
                        "title" => $data[0],
                        "category_id" => $category_id
                    ]);
                }
                $count++;
                // $article_titles[] = $data;
            }
            fclose($open);
        }
        return redirect()->route("backend.article_title-view")->with("success", "ArticleTitle Imported successfully.");
    }

    public function updateStatus(ArticleTitle $article_title)
    {
        if ($article_title && $article_title->id) {
            $article_title->status = !$article_title->status;
            $article_title->save();
            return redirect()->route("backend.article_title-view")->with("success", "ArticleTitle status updated successfully.");
        }
        return redirect()->route("backend.article_title-view")->with("error", "ArticleTitle not found.");
    }
}
