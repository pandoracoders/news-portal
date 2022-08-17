<?php

namespace App\Http\Controllers;

use App\Models\Backend\WebSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = WebSetting::where("type", "pages")->get();
        return view("backend.pages.page.index", compact("pages"));
    }


    public function edit($key)
    {
        $page = WebSetting::where("key", $key)->where("type", "pages")->first();
        return view("backend.pages.page.crud", compact("page"));
    }

    public function update(Request $request, $key)
    {
        $page = WebSetting::where("key", $key)->where("type", "pages")->first();
        $page->update($request->only(["value"]));
        if ($request->meta_title || $request->meta_description || $request->meta_keywords) {
            $page->seo()->updateOrCreate($request->only(["meta_title", "meta_description", "meta_keywords"]));
        }

        clearSettingCache();

        return redirect()->route("backend.page-view");
    }
}
