<?php

namespace App\Http\Controllers;

use App\Models\Backend\Article;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function youMayAlsoLike(Article $article)
    {
        return response()->json([
            'data' => getYouMayAlsoLike($article),
        ]);
    }


    public function getHomePageAjax()
    {
        return response()->json([
            'data' => getHomePageAjax(),
        ]);
    }


    function readMoreSection(Article $article)
    {
        return response()->json([
            'readMoreSection' => $article ?  getReadMoreSection($article) : '',
        ]);
    }
}
