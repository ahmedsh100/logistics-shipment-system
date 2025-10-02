@extends('admin.layouts.admin')

@section('title', 'تعديل العميل')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold text-dark">تعديل العميل: {{ $customer->name }}</h1>
    <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">
        <i class="fa-solid fa-arrow-right me-2"></i>العودة للقائمة
    </a>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('admin.customers.update', $customer) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">الاسم الكامل</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">رقم الهاتف</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور الجديدة (اتركها فارغة إذا لم تريد تغييرها)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save me-2"></i>حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
