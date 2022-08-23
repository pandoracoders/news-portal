<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\WebSettingRequest;
use App\Jobs\OrgSchema;
use App\Models\Backend\WebSetting;
use App\Services\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class WebSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!in_array(request()->type, config('constants.web_setting_tabs'))) {
            abort(404);
        }

        $webSetting = WebSetting::where('type', request()->type)
            ->get()
            ->keyBy('key');
        return view('backend.pages.setting.index', compact('webSetting'));
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        Cache::flush();
        return redirect()
            ->back()
            ->with('success', 'Cache cleared successfully');
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
        $validated = $request->validated();
        if (request()->allFiles()) {
            $files = request()->allFiles();
            foreach ($files as $key => $file) {
                $validated[$key] = ImageUpload::upload($file, $request->type, $key);
            }
        }

        foreach ($validated as $key => $value) {
            $old =
                WebSetting::where('key', $key)
                    ->where('type', request()->type)
                    ->first() ?? new WebSetting();
            if ($value) {
                $old->fill([
                    'key' => $key,
                    'value' => $value,
                    'type' => request()->type,
                ]);
                $old->save();
            } else {
                $old->delete();
            }
        }
        OrgSchema::dispatch();
        clearSettingCache();

        return redirect()
            ->back()
            ->with('success', 'Data updated successfully');
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
