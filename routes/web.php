<?php

use App\Http\Controllers\AjaxController;
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

// Route::get('sitemap.xml', [SitemapController::class, 'index']);


Route::get("/search", [FrontendController::class, "search"])->name("search");

Route::redirect('/home', '/', 301);

Route::redirect('/index', '/', 301);

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('{slug}', [FrontendController::class, 'singleArticle'])->name('singleArticle');

Route::get('tag/{tag:slug}', [FrontendController::class, 'tags'])->name('tags');

Route::post('category/{category:slug}', [FrontendController::class, 'categoryArticles'])
    ->name('categoryArticles')
    ->withoutMiddleware('csrf');

Route::post('tag/{tag:slug}', [FrontendController::class, 'tagArticles'])
    ->name('tagArticles')
    ->withoutMiddleware('csrf');
Route::post('author/{author:slug}', [FrontendController::class, 'authorArticles'])
    ->name('authorArticles')
    ->withoutMiddleware('csrf');

Route::get('author/{author:slug}', [FrontendController::class, 'authorArticle'])->name('authorArticle');

Route::get('/news/search/{field}/{value}', [FrontendController::class, 'searchByTableField'])->name('news.search');

Route::redirect('/backend', 'dashboard', 301)->middleware('auth');

// ajax route
Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
    Route::get('article/you-may-also-like/{article}', [AjaxController::class, 'youMayAlsoLike'])->name('youMayAlsoLike');
    Route::get('home-page-ajax', [AjaxController::class, 'getHomePageAjax'])->name('getHomePageAjax');
    Route::get('read-more/{article?}', [AjaxController::class, 'readMoreSection'])->name('readMoreSectionAjax');
});
