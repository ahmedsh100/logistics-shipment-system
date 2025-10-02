@extends('admin.layouts.admin')

@section('title', 'لوحة التحكم')

@section('content')
<h1 class="mb-4 fw-bold text-dark">نظرة عامة على النظام</h1>

{{-- بطاقات الإحصائيات الرئيسية --}}
<div class="row mb-5">
    {{-- إجمالي العملاء --}}
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card shadow border-start border-primary border-5 h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <i class="fa-solid fa-users fa-2x text-primary"></i>
                    </div>
                    <div class="col text-end">
                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                            إجمالي العملاء
                        </div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ number_format($stats['totalCustomers']) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- إجمالي الشحنات --}}
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card shadow border-start border-success border-5 h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <i class="fa-solid fa-box-open fa-2x text-success"></i>
                    </div>
                    <div class="col text-end">
                        <div class="text-xs fw-bold text-success text-uppercase mb-1">
                            إجمالي الشحنات
                        </div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ number_format($stats['totalShipments']) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- الشحنات قيد النقل --}}
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card shadow border-start border-info border-5 h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <i class="fa-solid fa-truck-fast fa-2x text-info"></i>
                    </div>
                    <div class="col text-end">
                        <div class="text-xs fw-bold text-info text-uppercase mb-1">
                            شحنات قيد النقل
                        </div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ number_format($stats['in_transit']) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- الاستفسارات الجديدة --}}
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card shadow border-start border-warning border-5 h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <i class="fa-solid fa-question-circle fa-2x text-warning"></i>
                    </div>
                    <div class="col text-end">
                        <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                            استفسارات العملاء
                        </div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ number_format($stats['totalInquiries']) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- توزيع الشحنات حسب الحالة --}}
<h2 class="mb-4 fw-bold text-dark">توزيع الشحنات</h2>
<div class="row">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2 text-center bg-light">
            <div class="card-body">
                <i class="fa-solid fa-folder-plus fa-3x text-secondary mb-3"></i>
                <div class="text-xs fw-bold text-secondary text-uppercase mb-1">جديدة / قيد التسجيل</div>
                <div class="h4 mb-0 fw-bold text-gray-800">{{ number_format($stats['new']) }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2 text-center bg-light">
            <div class="card-body">
                <i class="fa-solid fa-check-double fa-3x text-success mb-3"></i>
                <div class="text-xs fw-bold text-success text-uppercase mb-1">تم التوصيل</div>
                <div class="h4 mb-0 fw-bold text-gray-800">{{ number_format($stats['delivered']) }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2 text-center bg-light">
            <div class="card-body">
                <i class="fa-solid fa-clock fa-3x text-danger mb-3"></i>
                <div class="text-xs fw-bold text-danger text-uppercase mb-1">متأخرة</div>
                <div class="h4 mb-0 fw-bold text-gray-800">{{ number_format($stats['delayed']) }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2 text-center bg-light">
            <div class="card-body">
                <i class="fa-solid fa-route fa-3x text-primary mb-3"></i>
                <div class="text-xs fw-bold text-primary text-uppercase mb-1">المجموع الكلي</div>
                <div class="h4 mb-0 fw-bold text-gray-800">{{ number_format($stats['totalShipments']) }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
