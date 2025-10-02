@extends('layouts.main')

@section('title', 'الصفحة الرئيسية')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h1 class="display-4 fw-bold text-primary mb-3">تتبع شحنتك الآن</h1>
            <p class="lead text-muted mb-5">أدخل رقم التتبع الخاص بك لمعرفة آخر المستجدات حول شحنتك.</p>

            <div class="card shadow-lg p-4 mb-5 bg-white rounded-3">
                <div class="card-body">
                    <form action="{{ route('track.shipment') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-lg">
                            <input type="text" name="tracking_number" class="form-control form-control-lg rounded-pill-end @error('tracking_number') is-invalid @enderror" placeholder="أدخل رقم التتبع" required>
                            <button class="btn btn-primary rounded-pill-start fw-bold" type="submit">
                                <i class="fa-solid fa-magnifying-glass me-2"></i> تتبع
                            </button>
                            @error('tracking_number')<div class="invalid-feedback text-end">{{ $message }}</div>@enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- قسم الاتصال والاستفسارات --}}
    <div class="row justify-content-center mt-5" id="contact">
        <div class="col-lg-6">
            <h2 class="fw-bold text-center mb-4 text-dark">تواصل معنا</h2>
            <div class="card shadow p-4 rounded-3">
                <div class="card-body">
                    @if(session('success_inquiry'))
                        <div class="alert alert-success text-center">{{ session('success_inquiry') }}</div>
                    @endif
                    <form action="{{ route('inquiry.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">رسالتك</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="3" required>{{ old('message') }}</textarea>
                            @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">إرسال الاستفسار</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
