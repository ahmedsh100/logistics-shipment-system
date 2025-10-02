@extends('layouts.main')

@section('title', 'الصفحة الرئيسية')

@section('content')
<div class="container-fluid">
    {{-- قسم البطل الرئيسي --}}
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-lg-10 text-center">
            <div class="hero-section mb-5">
                <h1 class="display-3 fw-bold text-dark mb-4">
                    <i class="fa-solid fa-truck-fast text-primary me-3"></i>
                    تتبع شحنتك الآن
                </h1>
                <p class="lead text-muted mb-5 fs-4">أدخل رقم التتبع الخاص بك لمعرفة آخر المستجدات حول شحنتك في أي وقت ومن أي مكان</p>

                {{-- نموذج التتبع المحسن --}}
                <div class="tracking-card mb-5">
                    <div class="card shadow-lg border-0" style="border-radius: 25px; background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                        <div class="card-body p-5">
                            <form action="{{ route('track.shipment') }}" method="POST">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-md-8 mb-3 mb-md-0">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-primary text-white border-0" style="border-radius: 15px 0 0 15px;">
                                                <i class="fa-solid fa-search"></i>
                                            </span>
                                            <input type="text" 
                                                   name="tracking_number" 
                                                   class="form-control form-control-lg border-0 @error('tracking_number') is-invalid @enderror" 
                                                   placeholder="أدخل رقم التتبع الخاص بك" 
                                                   required
                                                   style="border-radius: 0; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);">
                                        </div>
                                        @error('tracking_number')
                                            <div class="invalid-feedback text-end d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary btn-lg w-100 fw-bold" type="submit" style="border-radius: 15px; padding: 15px;">
                                            <i class="fa-solid fa-magnifying-glass me-2"></i> تتبع الشحنة
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- المميزات --}}
                <div class="features-section">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="feature-card text-center p-4">
                                <div class="feature-icon mb-3">
                                    <i class="fa-solid fa-clock fa-3x text-success"></i>
                                </div>
                                <h5 class="fw-bold text-dark">تتبع فوري</h5>
                                <p class="text-muted">احصل على تحديثات فورية عن حالة شحنتك</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card text-center p-4">
                                <div class="feature-icon mb-3">
                                    <i class="fa-solid fa-shield-alt fa-3x text-primary"></i>
                                </div>
                                <h5 class="fw-bold text-dark">آمن وموثوق</h5>
                                <p class="text-muted">نظام آمن يحافظ على خصوصية معلوماتك</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-card text-center p-4">
                                <div class="feature-icon mb-3">
                                    <i class="fa-solid fa-mobile-screen fa-3x text-warning"></i>
                                </div>
                                <h5 class="fw-bold text-dark">متاح 24/7</h5>
                                <p class="text-muted">تتبع شحناتك في أي وقت ومن أي مكان</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- قسم الاتصال والاستفسارات --}}
    <div class="row justify-content-center mt-5" id="contact">
        <div class="col-lg-8">
            <div class="contact-section">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-dark mb-3">
                        <i class="fa-solid fa-envelope text-primary me-2"></i>
                        تواصل معنا
                    </h2>
                    <p class="text-muted fs-5">لديك استفسار؟ نحن هنا لمساعدتك</p>
                </div>
                
                <div class="card shadow-lg border-0" style="border-radius: 25px;">
                    <div class="card-body p-5">
                        @if(session('success_inquiry'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 15px;">
                                <i class="fa-solid fa-check-circle me-2"></i>
                                {{ session('success_inquiry') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <form action="{{ route('inquiry.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="name" class="form-label fw-bold text-dark">
                                        <i class="fa-solid fa-user me-2 text-primary"></i>الاسم الكامل
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required
                                           style="border-radius: 15px; border: 2px solid #e9ecef;"
                                           placeholder="أدخل اسمك الكامل">
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="email" class="form-label fw-bold text-dark">
                                        <i class="fa-solid fa-envelope me-2 text-primary"></i>البريد الإلكتروني
                                    </label>
                                    <input type="email" 
                                           class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required
                                           style="border-radius: 15px; border: 2px solid #e9ecef;"
                                           placeholder="example@email.com">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="message" class="form-label fw-bold text-dark">
                                    <i class="fa-solid fa-comment me-2 text-primary"></i>رسالتك
                                </label>
                                <textarea class="form-control form-control-lg @error('message') is-invalid @enderror" 
                                          id="message" 
                                          name="message" 
                                          rows="5" 
                                          required
                                          style="border-radius: 15px; border: 2px solid #e9ecef; resize: none;"
                                          placeholder="اكتب رسالتك هنا...">{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold px-5" style="border-radius: 25px;">
                                    <i class="fa-solid fa-paper-plane me-2"></i>إرسال الاستفسار
                                </button>
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

.tracking-card .card {
    transition: all 0.3s ease;
}

.tracking-card .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
}

.feature-card {
    background: rgba(255, 255, 255, 0.7);
    border-radius: 20px;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.feature-card:hover {
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.feature-icon {
    transition: all 0.3s ease;
}

.feature-card:hover .feature-icon {
    transform: scale(1.1);
}

.contact-section .card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    transition: all 0.3s ease;
}

.contact-section .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
}

.form-control:focus {
    border-color: #0d6efd !important;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}
</style>
@endsection