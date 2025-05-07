<?php

// app/Http/Controllers/SettingController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use App\Models\EmailSetting;
class SettingController extends Controller
{
    public function editGeneral()
    {
        $settings = Setting::where('key', 'general')->first();
        $settingsData = $settings ? $settings->value : [];
        return view('settings.general', ['settings' => (object) $settingsData]);
    }

    public function updateGeneral(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string',
            'company_logo' => 'nullable|image|max:2048',
            'address' => 'nullable|string',
            'time_zone' => 'required|string',
            'currency' => 'required|string',
            'fiscal_year' => 'required|date',
            'date_format' => 'required|string',
            'working_days' => 'array',
            'holidays' => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('company_logo')) {
            $data['company_logo'] = $request->file('company_logo')->store('logos', 'public');
        } else {
            $existing = Setting::where('key', 'general')->first();
            $data['company_logo'] = $existing->value['company_logo'] ?? null;
        }

        $data['working_days'] = $request->input('working_days', []);

        Setting::updateOrCreate(
            ['key' => 'general'],
            ['value' => $data]
        );

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
    public function editEmail()
{
    $settings = Setting::where('key', 'email')->first();
    $settingsData = $settings ? $settings->value : [];
    return view('settings.email', ['settings' => (object) $settingsData]);
}

public function updateEmail(Request $request)
{
    $data = $request->validate([
        'smtp_host'     => 'required|string',
        'smtp_port'     => 'required|numeric',
        'smtp_user'     => 'required|string',
        'smtp_pass'     => 'required|string',
        'from_address'  => 'required|email',
        'from_name'     => 'required|string',
    ]);

    Setting::updateOrCreate(
        ['key' => 'email'],
        ['value' => $data]
    );

    return redirect()->back()->with('success', 'Email settings updated.');
}

public function editNotifications()
{
    $settings = Setting::where('key', 'notifications')->first();
    $settingsData = $settings ? $settings->value : [];
    return view('settings.notifications', ['settings' => (object) $settingsData]);
}

public function updateNotifications(Request $request)
{
    $data = $request->validate([
        'enable_email' => 'boolean',
        'enable_sms' => 'boolean',
        'notification_frequency' => 'required|string',
    ]);

    Setting::updateOrCreate(
        ['key' => 'notifications'],
        ['value' => $data]
    );

    return redirect()->back()->with('success', 'Notification settings updated.');
}
// Show the email settings form
public function showEmailSettings()
{
    // Retrieve the email settings from the database (using Eloquent)
    $settings = EmailSetting::first();

    // Pass the settings to the view
    return view('settings.email', compact('settings'));
}

// Update the email settings
public function updateEmailSettings(Request $request)
{
    // Validate the input data
    $request->validate([
        'smtp_host' => 'required|string',
        'smtp_port' => 'required|string',
        'smtp_user' => 'required|string',
        'smtp_pass' => 'required|string',
        'from_address' => 'required|email',
        'from_name' => 'required|string',
    ]);

    // Retrieve the email settings and update them
    $settings = EmailSetting::first();  // Assuming you only have one record for email settings
    $settings->update([
        'smtp_host' => $request->smtp_host,
        'smtp_port' => $request->smtp_port,
        'smtp_user' => $request->smtp_user,
        'smtp_pass' => $request->smtp_pass,
        'from_address' => $request->from_address,
        'from_name' => $request->from_name,
    ]);

    // Redirect back with a success message
    return redirect()->route('settings.email.show')->with('success', 'Email settings updated successfully.');
}
}
