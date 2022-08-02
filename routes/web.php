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

Route::get("{slug}", [FrontendController::class, "singlePage"])->name("singlePage");




Route::redirect('/backend', 'dashboard', 301)->middleware("auth");

Route::get("/news/search/{field}/{value}", [FrontendController::class, "searchByTableField"])->name("news.search");
