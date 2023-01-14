<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Jobs\OrgSchema;
use App\Models\Backend\Article;
use App\Models\Backend\Category;
use App\Models\Backend\Tag;
use App\Models\Backend\User;
use DOMDocument;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    private $limit = 8;

    public function index()
    {
        return view("frontend.pages.home.index", [
            "data" => getHomePageCache(),
        ]);
    }


    public function search(Request $request)
    {
        $articles = Article::activeAndPublish()->where("title", "like", "%" . $request->q . "%")
                ->limit(15)
                ->get();
        if(count($articles) < 15){
            $n = 15 - count($articles);
            $ids = $articles->pluck('id')->toArray();
            $subArticles = Article::activeAndPublish()->where('body','like','%'.$request->q.'%')->whereNotIn('id',$ids)->limit($n)->get();
        }
        return view("frontend.pages.search.index", [
            "search_for" => $request->q,
            "articles" => $articles,
            "subArticles" => $subArticles
        ]);
    }

    public function singleArticle($slug)
    {
        $article = Article::activeAndPublish()->where("slug", $slug)->where("task_status", "published")->first();
        if ($article) {
            return view("frontend.pages.article.index", [
                "article" => $article,
            ]);
        }
        if (getSetting($slug)) {
            return view("frontend.pages.static-page", ["page" => getSetting($slug)]);
        }

        $category = Category::where("status", 1)->where("slug", $slug)->first();
        if ($category) {
            return view("frontend.pages.category.index", [
                "category" => $category,
                "schema" => getCategorySchema($category)
            ]);
        }

        return abort(404);
    }

    public function tags(Tag $tag)
    {
        if ($tag) {
            return view("frontend.pages.tag.index", [
                "tag" => $tag,
                "schema" => getTagSchema($tag)
            ]);
        } else {
            return abort(404);
        }
    }

    public function authorArticle(User $author)
    {
        if ($author) {
            return view("frontend.pages.author.index", [
                "author" => $author,
            ]);
        } else {
            return abort(404);
        }
    }

    public function categoryArticles(Category $category)
    {
        $limit = 9;
        $page = request()->get("page", 1);
        if (request()->ajax()) {
            $articles = $category->articles()
                ->where("task_status", "published")
                ->limit($limit)
                ->offset(($page) * $limit)
                ->orderBy("published_at", "desc")->get();
            return response()->json(ArticleResource::collection($articles), 200);
        }
        return abort(404);
    }
    public function tagArticles(Tag $tag)
    {
        $limit = 9;
        $page = request()->get("page", 1);
        if (request()->ajax()) {
            $articles = $tag->articles()
                ->where("task_status", "published")
                ->limit($limit)->offset(($page) * $limit)->get();
            return response()->json(ArticleResource::collection($articles), 200);
        }
        return abort(404);
    }
    public function authorArticles(User $author)
    {
        $limit = 9;
        $page = request()->get("page", 1);
        if (request()->ajax()) {
            $articles = $author->articles()
                ->where("task_status", "published")
                ->limit($limit)->offset(($page) * $limit)->get();
            return response()->json(ArticleResource::collection($articles), 200);
        }
        return abort(404);
    }

    public static function notFound()
    {
        return view("errors.404");
    }


    public function searchByTableField($field, $value)
    {
        $limit = 12;
        $today = explode("-",$value);
        if($field == 'birth' || $field == 'death'){
            $articles = Article::activeAndPublish()
            ->with(['category', 'writer'])
            ->where('task_status', 'published')
            ->where("tables->quick-facts->$field-month->value", ucfirst($today[0]))
            ->where("tables->quick-facts->$field-day->value", $today[1])
            ->limit(config('constants.article_limit', 8))
            ->get();
            return view('frontend.pages.table-search.index',[
                'articles' => $articles,
                'field' => "$field-day",
                'value' => $today[0].' '.$today[1]
            ]);
        }



        $page = request()->get("page", 1);
        if (request()->ajax()) {
            $articles = Article::searchJson($field, $value)->activeAndPublish()
                ->limit($limit)->offset(($page) * $limit)->get();
            return response()->json(ArticleResource::collection($articles), 200);
        }

        return view("frontend.pages.table-search.index", [
            "field" => $field,
            "value" => $value,
            "articles" => Article::searchJson($field, $value)->activeAndPublish()
                ->limit($limit)->get(),
        ]);
    }
}
