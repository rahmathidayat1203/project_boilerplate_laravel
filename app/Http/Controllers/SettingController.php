<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the settings.
     */
    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    /**
     * Update the specified setting in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'value' => 'required',
        ]);

        $setting->update([
            'value' => $request->value,
        ]);

        return redirect()->route('settings.index')->with('success', 'Setting updated successfully.');
    }

    /**
     * Remove the specified setting from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('settings.index')->with('success', 'Setting deleted successfully.');
    }
}
