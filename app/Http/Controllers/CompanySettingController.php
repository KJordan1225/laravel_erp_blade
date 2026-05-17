<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{
    public function index()
    {
        $setting = CompanySetting::firstOrCreate([
            'id' => 1,
        ], [
            'company_name' => 'Blue Orange ERP',
            'currency' => 'USD',
            'default_tax_rate' => 0,
        ]);

        return view('company-settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = CompanySetting::firstOrCreate(['id' => 1]);

        $data = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'tax_number' => ['nullable', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:10'],
            'default_tax_rate' => ['required', 'numeric', 'min:0'],
        ]);

        $setting->update($data);

        return redirect()
            ->route('company-settings.index')
            ->with('success', 'Company settings updated successfully.');
    }
}
