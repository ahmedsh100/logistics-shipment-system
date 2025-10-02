@extends('admin.layouts.admin')

@section('title', $title ?? 'قيد الإنشاء')

@section('content')
<h1 class="mb-4 fw-bold text-dark">{{ $title ?? 'الصفحة' }}</h1>
<div class="alert alert-info text-center p-4 shadow-sm">
    <i class="fa-solid fa-screwdriver-wrench fa-3x mb-3 text-primary"></i>
    <h4 class="mb-2">هذه الواجهة قيد البناء حالياً.</h4>
    <p class="lead">سيتم تطوير هذه الصفحة في الخطوات القادمة من **المرحلة 3** لإضافة وظائف CRUD.</p>
</div>
@endsection
