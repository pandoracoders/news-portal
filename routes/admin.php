<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TableSetController;
use App\Http\Controllers\Backend\TagController;
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



Route::redirect('/', 'dashboard', 301);

Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");

Route::group(['prefix' => 'category', "as" => "category-"], function () {
    Route::get("/", [CategoryController::class, "index"])->name("index");
    Route::get("/create", [CategoryController::class, "create"])->name("create");
    Route::post("/store", [CategoryController::class, "store"])->name("store");
    Route::get("/edit/{category}", [CategoryController::class, "edit"])->name("edit");
    Route::post("/update/{category}", [CategoryController::class, "update"])->name("update");
    Route::get("/delete/{category}", [CategoryController::class, "destroy"])->name("delete");
    Route::get("/status-update/{category}", [CategoryController::class, "updateStatus"])->name("update_status");
});

Route::group(['prefix' => 'table_set', "as" => "table_set-"], function () {
    Route::get("/", [TableSetController::class, "index"])->name("index");
    Route::get("/create", [TableSetController::class, "create"])->name("create");
    Route::post("/store", [TableSetController::class, "store"])->name("store");
    Route::get("/edit/{table_set}", [TableSetController::class, "edit"])->name("edit");
    Route::post("/update/{table_set}", [TableSetController::class, "update"])->name("update");
    Route::get("/delete/{table_set}", [TableSetController::class, "destroy"])->name("delete");
    Route::get("/status-update/{table_set}", [TableSetController::class, "updateStatus"])->name("update_status");
});

Route::group(['prefix' => 'tag', "as" => "tag-"], function () {
    Route::get("/", [TagController::class, "index"])->name("index");
    Route::get("/create", [TagController::class, "create"])->name("create");
    Route::post("/store", [TagController::class, "store"])->name("store");
    Route::get("/edit/{tag}", [TagController::class, "edit"])->name("edit");
    Route::post("/update/{tag}", [TagController::class, "update"])->name("update");
    Route::get("/delete/{tag}", [TagController::class, "destroy"])->name("delete");
    Route::get("/status-update/{tag}", [TagController::class, "updateStatus"])->name("update_status");
});


Route::group(['prefix' => 'article', "as" => "article-"], function () {
    Route::get("/", [TagController::class, "index"])->name("index");
    Route::get("/create", [TagController::class, "create"])->name("create");
    Route::post("/store", [TagController::class, "store"])->name("store");
    Route::get("/edit/{article}", [TagController::class, "edit"])->name("edit");
    Route::post("/update/{article}", [TagController::class, "update"])->name("update");
    Route::get("/delete/{article}", [TagController::class, "destroy"])->name("delete");
    Route::get("/status-update/{article}", [TagController::class, "updateStatus"])->name("update_status");
});
