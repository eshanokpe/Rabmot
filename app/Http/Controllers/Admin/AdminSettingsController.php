<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentCommissionSetting;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class AdminSettingsController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::current();
        $commissionSetting = AgentCommissionSetting::first();
        $isDown = app()->isDownForMaintenance();

        return view('admin.pages.settings.index', compact('settings', 'commissionSetting', 'isDown'));
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'support_email' => 'nullable|email|max:255',
            'support_phone' => 'nullable|string|max:50',
        ]);

        $this->save($validated);

        return redirect()->route('admin.settings.index')->with('success', 'General settings updated successfully.');
    }

    public function updateEmail(Request $request)
    {
        $validated = $request->validate([
            'mail_from_address' => 'nullable|email|max:255',
            'mail_from_name' => 'nullable|string|max:255',
        ]);

        $this->save($validated);

        return redirect()->route('admin.settings.index')->with('success', 'Email settings updated successfully.');
    }

    public function updateSms(Request $request)
    {
        $validated = $request->validate([
            'sms_provider' => 'nullable|string|max:255',
            'sms_sender_id' => 'nullable|string|max:255',
            'sms_api_key' => 'nullable|string|max:255',
            'sms_api_secret' => 'nullable|string|max:255',
        ]);

        $settings = Setting::current();
        $settings->sms_provider = $validated['sms_provider'] ?? null;
        $settings->sms_sender_id = $validated['sms_sender_id'] ?? null;
        if (!empty($validated['sms_api_key'])) {
            $settings->sms_api_key = $validated['sms_api_key'];
        }
        if (!empty($validated['sms_api_secret'])) {
            $settings->sms_api_secret = $validated['sms_api_secret'];
        }
        $settings->updated_by = Auth::guard('admin')->user()->id;
        $settings->save();
        Setting::forgetCache();

        return redirect()->route('admin.settings.index')->with('success', 'SMS provider settings updated successfully.');
    }

    public function updateWhatsapp(Request $request)
    {
        $validated = $request->validate([
            'whatsapp_phone_number_id' => 'nullable|string|max:255',
            'whatsapp_business_account_id' => 'nullable|string|max:255',
            'whatsapp_api_token' => 'nullable|string|max:255',
        ]);

        $settings = Setting::current();
        $settings->whatsapp_phone_number_id = $validated['whatsapp_phone_number_id'] ?? null;
        $settings->whatsapp_business_account_id = $validated['whatsapp_business_account_id'] ?? null;
        if (!empty($validated['whatsapp_api_token'])) {
            $settings->whatsapp_api_token = $validated['whatsapp_api_token'];
        }
        $settings->updated_by = Auth::guard('admin')->user()->id;
        $settings->save();
        Setting::forgetCache();

        return redirect()->route('admin.settings.index')->with('success', 'WhatsApp API settings updated successfully.');
    }

    public function updateCurrency(Request $request)
    {
        $validated = $request->validate([
            'currency_code' => 'required|string|size:3',
            'currency_symbol' => 'required|string|max:10',
        ]);

        $this->save($validated);

        return redirect()->route('admin.settings.index')->with('success', 'Currency settings updated successfully.');
    }

    public function updateTimezone(Request $request)
    {
        $validated = $request->validate([
            'timezone' => 'required|string|in:' . implode(',', timezone_identifiers_list()),
        ]);

        $this->save($validated);

        return redirect()->route('admin.settings.index')->with('success', 'Timezone updated successfully.');
    }

    public function enableMaintenance(Request $request)
    {
        $validated = $request->validate([
            'maintenance_message' => 'nullable|string|max:1000',
        ]);

        $this->save(['maintenance_message' => $validated['maintenance_message'] ?? null]);

        Artisan::call('down', array_filter([
            '--message' => $validated['maintenance_message'] ?? null,
        ]));

        return redirect()->route('admin.settings.index')->with('success', 'Maintenance mode enabled. The public site is now down.');
    }

    public function disableMaintenance(Request $request)
    {
        Artisan::call('up');

        return redirect()->route('admin.settings.index')->with('success', 'Maintenance mode disabled. The site is live again.');
    }

    private function save(array $validated): void
    {
        $settings = Setting::current();
        $settings->fill($validated);
        $settings->updated_by = Auth::guard('admin')->user()->id;
        $settings->save();
        Setting::forgetCache();
    }
}
