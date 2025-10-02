@extends('layouts.main')

@section('title', 'تسجيل عميل جديد')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-lg-6 col-md-8">
            <div class="auth-card">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-success text-white text-center py-4">
                        <div class="auth-icon mb-3">
                            <i class="fa-solid fa-user-plus fa-3x"></i>
                        </div>
                        <h3 class="mb-0 fw-bold">إنشاء حساب جديد</h3>
                        <p class="mb-0 opacity-75">انضم إلينا واستمتع بخدمة التتبع المتقدمة</p>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('customer.register') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="name" class="form-label fw-bold text-dark">
                                        <i class="fa-solid fa-user text-success me-2"></i>الاسم الكامل
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required 
                                           autofocus
                                           style="border-radius: 12px; border: 2px solid #e9ecef;"
                                           placeholder="أدخل اسمك الكامل">
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="phone" class="form-label fw-bold text-dark">
                                        <i class="fa-solid fa-phone text-success me-2"></i>رقم الهاتف
                                    </label>
                                    <input type="tel" 
                                           class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone') }}"
                                           style="border-radius: 12px; border: 2px solid #e9ecef;"
                                           placeholder="+966 50 123 4567">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold text-dark">
                                    <i class="fa-solid fa-envelope text-success me-2"></i>البريد الإلكتروني
                                </label>
                                <input type="email" 
                                       class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required
                                       style="border-radius: 12px; border: 2px solid #e9ecef;"
                                       placeholder="example@email.com">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="password" class="form-label fw-bold text-dark">
                                        <i class="fa-solid fa-lock text-success me-2"></i>كلمة المرور
                                    </label>
                                    <input type="password" 
                                           class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           required
                                           style="border-radius: 12px; border: 2px solid #e9ecef;"
                                           placeholder="كلمة مرور قوية">
                                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="password_confirmation" class="form-label fw-bold text-dark">
                                        <i class="fa-solid fa-lock text-success me-2"></i>تأكيد كلمة المرور
                                    </label>
                                    <input type="password" 
                                           class="form-control form-control-lg" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           required
                                           style="border-radius: 12px; border: 2px solid #e9ecef;"
                                           placeholder="أعد إدخال كلمة المرور">
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label text-muted" for="terms">
                                        أوافق على <a href="#" class="text-success fw-bold">الشروط والأحكام</a> و <a href="#" class="text-success fw-bold">سياسة الخصوصية</a>
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-3">
                                <button type="submit" class="btn btn-success btn-lg fw-bold" style="border-radius: 12px; padding: 15px;">
                                    <i class="fa-solid fa-user-plus me-2"></i>إنشاء الحساب
                                </button>
                                <hr class="my-3">
                                <a href="{{ route('customer.login') }}" class="btn btn-outline-success btn-lg fw-bold" style="border-radius: 12px; padding: 15px;">
                                    <i class="fa-solid fa-sign-in-alt me-2"></i>لديك حساب بالفعل؟ سجل دخولك
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
    border-color: #198754 !important;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25) !important;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.card-header {
    background: linear-gradient(135deg, #198754 0%, #20c997 100%) !important;
}

.form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}

.form-check-input:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
}
</style>
@endsection
