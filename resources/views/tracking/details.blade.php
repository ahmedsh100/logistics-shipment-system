@extends('layouts.main')

@section('title', 'تفاصيل التتبع')

@section('content')
<div class="container my-5">
    @if($shipment)
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">
                            <i class="fa-solid fa-truck me-2"></i>
                            تفاصيل الشحنة
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="text-primary">رقم التتبع</h5>
                                <p class="h4">{{ $shipment->tracking_number }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-primary">حالة الشحنة</h5>
                                <span class="badge 
                                    @if($shipment->status == 'new') bg-info
                                    @elseif($shipment->status == 'in_transit') bg-warning
                                    @elseif($shipment->status == 'delivered') bg-success
                                    @else bg-danger
                                    @endif fs-6">
                                    @if($shipment->status == 'new') جديدة
                                    @elseif($shipment->status == 'in_transit') في الطريق
                                    @elseif($shipment->status == 'delivered') تم التسليم
                                    @else متأخرة
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="text-primary">العميل</h5>
                                <p>{{ $shipment->customer->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-primary">المبلغ</h5>
                                <p>{{ number_format($shipment->amount, 2) }} ريال</p>
                            </div>
                        </div>

                        @if($shipment->description)
                            <div class="mb-4">
                                <h5 class="text-primary">وصف الشحنة</h5>
                                <p>{{ $shipment->description }}</p>
                            </div>
                        @endif

                        <hr>

                        <h5 class="text-primary mb-3">
                            <i class="fa-solid fa-route me-2"></i>
                            مسار الشحنة
                        </h5>

                        @if($shipment->steps->count() > 0)
                            <div class="timeline">
                                @foreach($shipment->steps as $index => $step)
                                    <div class="timeline-item {{ $index == 0 ? 'active' : '' }}">
                                        <div class="timeline-marker 
                                            @if($index == 0) bg-primary
                                            @elseif($shipment->status == 'delivered' && $index == $shipment->steps->count() - 1) bg-success
                                            @else bg-secondary
                                            @endif">
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">{{ $step->status }}</h6>
                                            @if($step->location)
                                                <p class="text-muted mb-1">
                                                    <i class="fa-solid fa-location-dot me-1"></i>
                                                    {{ $step->location }}
                                                </p>
                                            @endif
                                            @if($step->description)
                                                <p class="mb-1">{{ $step->description }}</p>
                                            @endif
                                            <small class="text-muted">
                                                <i class="fa-solid fa-clock me-1"></i>
                                                {{ $step->step_date ? $step->step_date->format('Y-m-d H:i') : $step->created_at->format('Y-m-d H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                <i class="fa-solid fa-info-circle me-2"></i>
                                لم يتم إضافة أي خطوات تتبع بعد
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-arrow-right me-2"></i>
                        العودة للصفحة الرئيسية
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                        <h4 class="text-warning">لم يتم العثور على الشحنة</h4>
                        <p class="text-muted">رقم التتبع المدخل غير صحيح أو غير موجود</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fa-solid fa-arrow-right me-2"></i>
                            العودة للصفحة الرئيسية
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 5px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 3px #dee2e6;
}

.timeline-item.active .timeline-marker {
    box-shadow: 0 0 0 3px #007bff;
}

.timeline-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-right: 4px solid #007bff;
}
</style>
@endsection
