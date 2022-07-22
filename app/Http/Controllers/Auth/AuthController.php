<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{


    public function login()
    {

        if (!request()->hasValidSignature() && !session()->has("valid-user")) {
            abort(404);
        }
        return view("auth.pages.login");
    }
}
