@extends('layouts.app')

@section('title', 'Profile - Blue Orange ERP')
@section('page_title', 'My Profile')
@section('page_subtitle', 'Update your account information')

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="erp-card">
            <div class="p-3 border-bottom">
                <h5 class="mb-0 text-primary fw-bold">Profile Information</h5>
            </div>

            <div class="p-4">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">
                            Name <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control" 
                            value="{{ old('name', auth()->user()->name) }}" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Email <span class="required">*</span>
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            value="{{ old('email', auth()->user()->email) }}" 
                            required
                        >
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control"
                        >
                        <small class="text-muted">Leave blank if you do not want to change your password.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            class="form-control"
                        >
                    </div>

                    <button class="btn btn-orange" type="submit">
                        <i class="bi bi-save me-1"></i>
                        Save Profile
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
