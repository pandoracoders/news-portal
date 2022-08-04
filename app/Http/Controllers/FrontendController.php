<?php

namespace App\Http\Controllers;

use App\Models\Backend\Article;
use App\Models\Backend\Category;
use App\Models\Backend\Tag;

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

    public function singlePage($slug)
    {
        $category = Category::where("slug", $slug)->first();
        if ($category) {
            // return category page
            dd($category);
        }
        $article = Article::where("slug", $slug)->first();
        if ($article) {
            // return article page
            dd($article);
        }
        return abort(404);
    }



    public function searchByTableField($field, $value)
    {
        dd($field, $value);
    }


    private function getFeaturedArticle()
    {
        return Article::where("is_featured", 1)->limit($this->limit)->get();
    }
}
