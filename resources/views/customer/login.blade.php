@extends('layouts.main')

@section('title', 'دخول العملاء')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-lg-5 col-md-7">
            <div class="auth-card">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <div class="auth-icon mb-3">
                            <i class="fa-solid fa-user-circle fa-3x"></i>
                        </div>
                        <h3 class="mb-0 fw-bold">تسجيل دخول العملاء</h3>
                        <p class="mb-0 opacity-75">مرحباً بك مرة أخرى</p>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('customer.login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold text-dark">
                                    <i class="fa-solid fa-envelope text-primary me-2"></i>البريد الإلكتروني
                                </label>
                                <input type="email" 
                                       class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autofocus
                                       style="border-radius: 12px; border: 2px solid #e9ecef;"
                                       placeholder="أدخل بريدك الإلكتروني">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold text-dark">
                                    <i class="fa-solid fa-lock text-primary me-2"></i>كلمة المرور
                                </label>
                                <input type="password" 
                                       class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       required
                                       style="border-radius: 12px; border: 2px solid #e9ecef;"
                                       placeholder="أدخل كلمة المرور">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label fw-bold text-dark" for="remember">
                                    تذكرني في المرة القادمة
                                </label>
                            </div>

                            <div class="d-grid gap-3">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold" style="border-radius: 12px; padding: 15px;">
                                    <i class="fa-solid fa-sign-in-alt me-2"></i>دخول إلى حسابي
                                </button>
                                <hr class="my-3">
                                <a href="{{ route('customer.register') }}" class="btn btn-outline-primary btn-lg fw-bold" style="border-radius: 12px; padding: 15px;">
                                    <i class="fa-solid fa-user-plus me-2"></i>ليس لديك حساب؟ سجل الآن
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.min-vh-75 {
    min-height: 75vh;
}

.auth-card {
    animation: slideInUp 0.6s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.auth-icon {
    animation: bounceIn 1s ease-out;
}

@keyframes bounceIn {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

.card {
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
}

.form-control:focus {
    border-color: #0d6efd !important;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}
</style>
@endsection
