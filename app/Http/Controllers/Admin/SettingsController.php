<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    use HasUploader;
    /**
     * Display the data of the Settings
     */
    public function maanSettings()
    {
        $info = Settings::first();
        return view('back-end.pages.settings.settings_info', compact('info'));
    }

    /**
     * Updated a listing of the  requested data.
     */
    public function maanUpdateSettings(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'title' => 'required|max:100',
            'content' => 'required|max:2000',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:50/50',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200',
        ]);

        Cache::forget('settings');
        $settings = Settings::find($id);
        $settings->update($request->except('favicon', 'header_logo', 'footer_logo') + [
            'favicon' => $request->favicon ? $this->upload($request, 'favicon', $settings->favicon) : $settings->favicon,
            'header_logo' => $request->header_logo ? $this->upload($request, 'header_logo', $settings->header_logo) : $settings->header_logo,
            'footer_logo' => $request->footer_logo ? $this->upload($request, 'footer_logo', $settings->footer_logo) : $settings->footer_logo,
        ]);

        return response()->json([
            'message' => __('Settings updated successfully.'),
            'redirect' => url('settings'),
        ]);
    }
}
