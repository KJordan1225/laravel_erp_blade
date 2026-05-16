@extends('layouts.guest')

@section('title', 'Register - Blue Orange ERP')

@section('content')
<div class="auth-card">
    <div class="auth-logo">
        <i class="bi bi-grid-1x2-fill"></i>
    </div>

    <h1 class="auth-title">Create Account</h1>
    <p class="auth-subtitle">Start using your ERP system</p>

    @include('partials.flash')

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">
                Name <span class="required">*</span>
            </label>
            <input 
                type="text" 
                name="name" 
                class="form-control" 
                value="{{ old('name') }}" 
                required 
                autofocus
            >
        </div>

        <div class="mb-3">
            <label class="form-label">
                Email Address <span class="required">*</span>
            </label>
            <input 
                type="email" 
                name="email" 
                class="form-control" 
                value="{{ old('email') }}" 
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">
                Password <span class="required">*</span>
            </label>
            <input 
                type="password" 
                name="password" 
                class="form-control" 
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">
                Confirm Password <span class="required">*</span>
            </label>
            <input 
                type="password" 
                name="password_confirmation" 
                class="form-control" 
                required
            >
        </div>

        <button class="btn btn-orange w-100" type="submit">
            <i class="bi bi-person-plus me-1"></i>
            Register
        </button>
    </form>

    <div class="text-center mt-3">
        <span class="text-muted">Already have an account?</span>
        <a href="{{ route('login') }}">Login</a>
    </div>
</div>
@endsection
