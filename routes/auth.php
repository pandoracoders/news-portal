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

Route::get("/2fa/enable", [AuthController::class, "enableTwoFactor"])->name("2fa-enable")->middleware("auth");
// Route::post("/2fa/enable", [AuthController::class, "postEnableTwoFactor"])->name("2fa-enable-post");


Route::get('/2fa/validate', [AuthController::class, "validate2FA"])->name("validate-2fa")->middleware("auth");
Route::post("/2fa/validate", [AuthController::class, "postValidate2FA"])->name("post-validate-2fa")->middleware(["throttle:5", "auth"]);
