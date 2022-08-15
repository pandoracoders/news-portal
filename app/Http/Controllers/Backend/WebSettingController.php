<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\WebSettingRequest;
use App\Models\Backend\WebSetting;
use App\Services\ImageUpload;
use Illuminate\Http\Request;

class WebSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!in_array(request()->type, config("constants.web_setting_tabs"))) {
            abort(404);
        }

        $webSetting = WebSetting::where("type", request()->type)->get()->keyBy("key");
        return view("backend.pages.setting.index", compact("webSetting"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WebSettingRequest $request, $id)
    {
        $validated = ($request->validated());
        if (request()->allFiles()) {
            $files = request()->allFiles();
            foreach ($files as $key => $file) {
                $validated[$key] = ImageUpload::upload($file, $request->type, $key);
            }
        }

        $keys = array_keys($validated);

        $dataToSave = array_map(function ($key, $value) {
            if ($value) {
                return [
                    "key" => $key,
                    "value" => $value,
                    "type" => request()->type,
                ];
            }
            return [];
        }, $keys, $validated);


        // delete old data
        WebSetting::whereIn("key", $keys)->where("type", request()->type)->delete();

        // save new data
        WebSetting::insert(array_filter($dataToSave));

        return redirect()->back()->with("success", "Data updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
