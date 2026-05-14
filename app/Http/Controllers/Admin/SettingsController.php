<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'        => 'required|string|max:255',
            'site_email'       => 'required|email',
            'calendly_url'     => 'nullable|url',
            'behance_url'      => 'nullable|url',
            'instagram_url'    => 'nullable|url',
            'dribbble_url'     => 'nullable|url',
            'footer_text'      => 'nullable|string',
            'about_video'      => 'nullable|file|mimes:mp4,webm|max:51200',
            'logo'             => 'nullable|image|mimes:webp,png,jpg|max:2048',
            'favicon'          => 'nullable|image|mimes:png,ico|max:512',
        ]);

        $fields = [
            'site_name', 'site_email', 'calendly_url',
            'behance_url', 'instagram_url', 'dribbble_url', 'footer_text'
        ];

        foreach ($fields as $field) {
            SiteSetting::updateOrCreate(
                ['key' => $field],
                ['value' => $request->input($field)]
            );
        }

        // Handle file uploads
        if ($request->hasFile('logo')) {
            $old = SiteSetting::where('key', 'logo')->value('value');
            if ($old) Storage::disk('public')->delete($old);
            $path = $request->file('logo')->store('settings', 'public');
            SiteSetting::updateOrCreate(['key' => 'logo'], ['value' => $path]);
        }

        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('settings', 'public');
            SiteSetting::updateOrCreate(['key' => 'favicon'], ['value' => $path]);
        }

        if ($request->hasFile('about_video')) {
            $old = SiteSetting::where('key', 'about_video')->value('value');
            if ($old) Storage::disk('public')->delete($old);
            $path = $request->file('about_video')->store('settings/videos', 'public');
            SiteSetting::updateOrCreate(['key' => 'about_video'], ['value' => $path]);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings saved!');
    }
}
