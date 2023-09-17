<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateSettingsRequest;
use App\Models\Setting;
use App\Traits\Upload;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use Upload;

    public function __construct()
    {
        $this->middleware('can:show settings', ['only' => ['index']]);
        $this->middleware('can:edit settings', ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        return view('dashboard.settings.index', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $setting = Setting::findOrFail($id);
        return view('dashboard.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingsRequest $request, string $id)
    {
        try {
            $setting = Setting::findOrFail($id);
            $setting->update([
                'website_name' => $request->website_name,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'copyright' => $request->copyright,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'instagram' => $request->address,
            ]);

            if ($request->logo) {
                $this->removeImage($setting->logo);
                $logo = $this->uploadImage($request->logo, 'logo/');
                $setting->update([
                    'logo' => $logo,
                ]);
            }
            session()->flash('edit');
            return redirect(route('settings.index'));
        } catch(Exception $e) {
            return $e->getMessage();
            session()->flash('error');
            return redirect(route('settings.index'));
        }
    }

}
