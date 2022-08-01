<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function searchByTableField($field, $value)
    {
        dd($field, $value);
    }
}
