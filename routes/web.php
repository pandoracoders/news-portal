<?php

use App\Http\Controllers\FrontendController;
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
