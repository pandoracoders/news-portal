<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Backend\Article;
use App\Models\Backend\Category;
use App\Models\Backend\Tag;
use App\Models\Backend\User;

class FrontendController extends Controller
{

    private $limit = 8;

    public function index()
    {
        // clearHomePageCache();

        return view("frontend.pages.home.index", [
            "data" => getHomePageCache(),
        ]);
    }

    public function singleArticle($slug)
    {
        $category = Category::where("status", 1)->where("slug", $slug)->first();
        if ($category) {
            return view("frontend.pages.category.index", [
                "category" => $category,
            ]);
        }
        $article = Article::where("slug", $slug)->where("task_status", "published")->first();
        if ($article) {
            return view("frontend.pages.article.index", [
                "article" => $article,
            ]);
        }
        return abort(404);
    }

    public function tags(Tag $tag)
    {
        if ($tag) {
            return view("frontend.pages.tag.index", [
                "tag" => $tag,
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
                ->offset(($page) * $limit)->get();
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
}
