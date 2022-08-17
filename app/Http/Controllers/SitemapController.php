<?php

namespace App\Http\Controllers;

use App\Models\Backend\Article;
use App\Models\Backend\Category;
use App\Models\Backend\Tag;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $static_routes = ["home"];
        $category = Category::select("slug", "updated_at")->get();
        $tags = Tag::select("slug", "updated_at")->get();
        $articles = Article::select("slug", "updated_at")->get();
        return response()->view("frontend.pages.sitemap.index", compact("static_routes", "category", "tags", "articles"))->header('Content-Type', 'text/xml');
    }
}
