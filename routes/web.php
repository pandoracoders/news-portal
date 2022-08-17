<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SitemapController;
use App\Models\Backend\Article;
use App\Models\Backend\Category;
use App\Models\Backend\Role;
use App\Models\Backend\Tag;
use App\Models\Backend\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("sitemap.xml", [SitemapController::class, "index"]);


Route::get('/seed/db', function () {

    $json = file_get_contents(base_path("database/seeds/wikibioages.json"));
    $data = json_decode($json, true);

    foreach ($data as $key => $post) {
        // create author




        $author = User::updateOrCreate(["slug" => $post["author"]["user_nicename"]], [
            "name" => $post["author"]["display_name"],
            "email" => $post["author"]["user_email"],
            "password" => bcrypt("@pandora@"),
            "alias_name" => $post["author"]["display_name"]
        ]);
        $author->permission()->updateOrCreate(["user_id" => $author->id], [
            "role_id" => Role::where("title", "Writer")->first()->id,
            "permissions" => config("constants.writer_permissions"),

        ]);



        // create of find category
        $category = Category::firstOrCreate($post['category'][0]);


        $article = Article::create(array_merge($post, [
            "slug" => $post["task_status"] == "publish" ? $post["slug"] : str_slug($post["title"]),
            'category_id' => $category->id,
            'writer_id' => $author->id,
            'editor_id' => 1,
            "image" => replaceOrigin($post["feature_image"]),
            "body" => replaceOrigin($post["body"]),
            "task_status" => $post["task_status"] == "publish" ? "published" : "submitted"
        ]));

        $tags = [];
        foreach ($post["tags"] as $key => $tag) {
            $tags[] = Tag::firstOrCreate($tag)->id;
        }
        $article->tags()->attach($tags);
    }


    return $data;
});



Route::redirect("/home", "/", 301);

Route::redirect("/index", "/", 301);

Route::get("/", [FrontendController::class, "index"])->name("home");

Route::get("{slug}", [FrontendController::class, "singleArticle"])->name("singleArticle");

Route::get("tag/{tag:slug}", [FrontendController::class, "tags"])->name("tags");

Route::post("category/{category:slug}", [FrontendController::class, "categoryArticles"])->name("categoryArticles")->withoutMiddleware("csrf");
Route::post("tag/{tag:slug}", [FrontendController::class, "tagArticles"])->name("tagArticles")->withoutMiddleware("csrf");
Route::post("author/{author:slug}", [FrontendController::class, "authorArticles"])->name("authorArticles")->withoutMiddleware("csrf");


Route::get("author/{author:slug}", [FrontendController::class, "authorArticle"])->name("authorArticle");


Route::get("/news/search/{field}/{value}", [FrontendController::class, "searchByTableField"])->name("news.search");


Route::redirect('/backend', 'dashboard', 301)->middleware("auth");
