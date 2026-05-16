@extends('layouts.guest')

@section('title', 'Login - Blue Orange ERP')

@section('content')
<div class="auth-card">
    <div class="auth-logo">
        <i class="bi bi-grid-1x2-fill"></i>
    </div>

    <h1 class="auth-title">Welcome Back</h1>
    <p class="auth-subtitle">Login to your ERP dashboard</p>

    @include('partials.flash')

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

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
                autofocus
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

        <div class="form-check mb-3">
            <input 
                class="form-check-input" 
                type="checkbox" 
                name="remember" 
                id="remember"
            >
            <label class="form-check-label" for="remember">
                Remember me
            </label>
        </div>

        <button class="btn btn-orange w-100" type="submit">
            <i class="bi bi-box-arrow-in-right me-1"></i>
            Login
        </button>
    </form>

    <div class="text-center mt-3">
        <span class="text-muted">Need an account?</span>
        <a href="{{ route('register') }}">Register</a>
    </div>
</div>
@endsection
