<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use PharIo\Manifest\AuthorCollection;

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

Route::get('/1234', function () {
    session()->put("valid-user", "true");
    $url = (URL::temporarySignedRoute('login', now()->addMinutes(1)));
    return redirect()->away($url);
});

Route::get('/login', [AuthController::class, "login"])->name("login");
Route::post("/login", [AuthController::class, "postLogin"])->name("post-login");
