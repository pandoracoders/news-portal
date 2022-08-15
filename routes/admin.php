<?php

use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\Backend\ArticleTitleController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\TableSetController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WebSettingController;
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




Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");

Route::group(['prefix' => 'category', "as" => "category-"], function () {
    Route::get("/", [CategoryController::class, "index"])->name("view");
    Route::get("/create", [CategoryController::class, "create"])->name("create");
    Route::post("/store", [CategoryController::class, "store"])->name("store");
    Route::get("/edit/{category}", [CategoryController::class, "edit"])->name("edit");
    Route::post("/update/{category}", [CategoryController::class, "update"])->name("update");
    Route::get("/delete/{category}", [CategoryController::class, "destroy"])->name("delete");
    Route::get("/status-update/{category}", [CategoryController::class, "updateStatus"])->name("update_status");
});

Route::group(['prefix' => 'table_set', "as" => "table_set-"], function () {
    Route::get("/", [TableSetController::class, "index"])->name("view");
    Route::get("/create", [TableSetController::class, "create"])->name("create");
    Route::post("/store", [TableSetController::class, "store"])->name("store");
    Route::get("/edit/{table_set}", [TableSetController::class, "edit"])->name("edit");
    Route::post("/update/{table_set}", [TableSetController::class, "update"])->name("update");
    Route::get("/delete/{table_set}", [TableSetController::class, "destroy"])->name("delete");
    Route::get("/status-update/{table_set}", [TableSetController::class, "updateStatus"])->name("update_status");
});

Route::group(['prefix' => 'tag', "as" => "tag-"], function () {
    Route::get("/", [TagController::class, "index"])->name("view");
    Route::get("/create", [TagController::class, "create"])->name("create");
    Route::post("/store", [TagController::class, "store"])->name("store");
    Route::get("/edit/{tag}", [TagController::class, "edit"])->name("edit");
    Route::post("/update/{tag}", [TagController::class, "update"])->name("update");
    Route::get("/delete/{tag}", [TagController::class, "destroy"])->name("delete");
    Route::get("/status-update/{tag}", [TagController::class, "updateStatus"])->name("update_status");
});


Route::group(['prefix' => 'article', "as" => "article-"], function () {
    Route::get("/{task_status?}", [ArticleController::class, "index"])->name("view");
    Route::get("/create", [ArticleController::class, "create"])->name("create");
    Route::post("/store", [ArticleController::class, "store"])->name("store");
    Route::get("/edit/{article}", [ArticleController::class, "edit"])->name("edit");
    Route::post("/update/{article}", [ArticleController::class, "update"])->name("update");
    Route::get("/delete/{article}", [ArticleController::class, "destroy"])->name("delete");
    Route::get("/status-update/{article}", [ArticleController::class, "updateStatus"])->name("update_status");

    Route::get("/task-status-update/{article}/{taskStatus}", [ArticleController::class, "updateTaskStatus"])->name("update_task_status");
});


Route::group(['prefix' => 'article-title', "as" => "article_title-"], function () {
    Route::get("/", [ArticleTitleController::class, "index"])->name("view");
    Route::get("/create", [ArticleTitleController::class, "create"])->name("create");
    Route::post("/store", [ArticleTitleController::class, "store"])->name("store");
    Route::get("/edit/{article_title}", [ArticleTitleController::class, "edit"])->name("edit");
    Route::post("/update/{article_title}", [ArticleTitleController::class, "update"])->name("update");
    Route::get("/delete/{article_title}", [ArticleTitleController::class, "destroy"])->name("delete");

    Route::get("/status-update/{article_title}", [ArticleTitleController::class, "updateStatus"])->name("update_status");

    Route::get("/pick/{article_title}", [ArticleTitleController::class, "pick"])->name("pick");

    // import xlsx

    Route::get("/import", [ArticleTitleController::class, "import"])->name("import");
});

Route::group(['prefix' => 'user', "as" => "user-"], function () {
    Route::get("/", [UserController::class, "index"])->name("view");
    Route::get("/create", [UserController::class, "create"])->name("create");
    Route::post("/store", [UserController::class, "store"])->name("store");
    Route::get("/edit/{user}", [UserController::class, "edit"])->name("edit");
    Route::post("/update/{user}", [UserController::class, "update"])->name("update");
    Route::get("/delete/{user}", [UserController::class, "destroy"])->name("delete");
    Route::get("/status-update/{user}", [UserController::class, "updateStatus"])->name("update_status");
});


Route::group(['prefix' => 'role', "as" => "role-"], function () {
    Route::get("/", [RoleController::class, "index"])->name("view");
    Route::get("/create", [RoleController::class, "create"])->name("create");
    Route::post("/store", [RoleController::class, "store"])->name("store");
    Route::get("/edit/{role}", [RoleController::class, "edit"])->name("edit");
    Route::post("/update/{role}", [RoleController::class, "update"])->name("update");
    Route::get("/delete/{role}", [RoleController::class, "destroy"])->name("delete");
    Route::get("/status-update/{role}", [RoleController::class, "updateStatus"])->name("update_status");
});

Route::group(['prefix' => 'setting', "as" => "setting-"], function () {
    Route::get("/{type}", [WebSettingController::class, "index"])->name("view");
    Route::post("/update/{type}", [WebSettingController::class, "update"])->name("update");
});
