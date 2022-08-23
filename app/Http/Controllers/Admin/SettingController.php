<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Traits\UploadAble;
use App\Models\Setting;


class SettingController extends BaseController
{
    use UploadAble;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.Setting.index');
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->has('site_logo') && ($request->file('site_logo') instanceof UploadedFile)) {
            if (config('settings.site_logo') != null) {
                $this->deleteOne(config('settings.site_logo'));
            }

            $logo = $this->uploadOne($request->file('site_logo'), 'img');
            Setting::set('site_logo', $logo);
        } elseif ($request->has('site_favicon') && ($request->file('site_favicon') instanceof UploadedFile)) {
    
            if (config('settings.site_favicon') != null) {
                $this->deleteOne(config('settings.site_favicon'));
            }
            $favicon = $this->uploadOne($request->file('site_favicon'), 'img');
            Setting::set('site_favicon', $favicon);
    
        } else {
    
            $keys = $request->except('_token');
            
            foreach ($keys as $key => $value)
            {
                Setting::set($key, $value);
            }
        }
        return $this->responseRedirectBack('Settings updated successfully.', 'success');
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
