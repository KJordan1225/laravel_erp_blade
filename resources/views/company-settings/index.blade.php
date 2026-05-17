@extends('layouts.app')

@section('title', 'Company Settings - Blue Orange ERP')
@section('page_title', 'Company Settings')
@section('page_subtitle', 'Manage company information')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="erp-card">
            <div class="p-3 border-bottom">
                <h5 class="mb-0 text-primary fw-bold">Company Information</h5>
            </div>

            <div class="p-4">
                <form method="POST" action="{{ route('company-settings.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">
                                Company Name <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="company_name" 
                                class="form-control" 
                                value="{{ old('company_name', $setting->company_name) }}" 
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                class="form-control" 
                                value="{{ old('email', $setting->email) }}"
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input 
                                type="text" 
                                name="phone" 
                                class="form-control" 
                                value="{{ old('phone', $setting->phone) }}"
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tax Number</label>
                            <input 
                                type="text" 
                                name="tax_number" 
                                class="form-control" 
                                value="{{ old('tax_number', $setting->tax_number) }}"
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                Currency <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="currency" 
                                class="form-control" 
                                value="{{ old('currency', $setting->currency) }}" 
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                Default Tax Rate <span class="required">*</span>
                            </label>
                            <input 
                                type="number" 
                                name="default_tax_rate" 
                                class="form-control" 
                                value="{{ old('default_tax_rate', $setting->default_tax_rate) }}" 
                                min="0" 
                                step="0.01" 
                                required
                            >
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="4">{{ old('address', $setting->address) }}</textarea>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-orange" type="submit">
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
