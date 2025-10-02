@extends('admin.layouts.admin')

@section('title', 'خطوات التتبع')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold text-dark">خطوات التتبع - {{ $shipment->tracking_number }}</h1>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStepModal">
            <i class="fa-solid fa-plus me-2"></i>إضافة خطوة جديدة
        </button>
        <a href="{{ route('admin.shipments.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-right me-2"></i>العودة للشحنات
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow">
    <div class="card-header bg-light">
        <h5 class="mb-0">تفاصيل الشحنة</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <strong>العميل:</strong> {{ $shipment->customer->name }}
            </div>
            <div class="col-md-3">
                <strong>المبلغ:</strong> {{ number_format($shipment->amount, 2) }} ريال
            </div>
            <div class="col-md-3">
                <strong>الحالة:</strong>
                @php
                    $statusClass = match($shipment->status) {
                        'delivered' => 'success',
                        'in_transit' => 'info',
                        'delayed' => 'danger',
                        default => 'secondary',
                    };
                @endphp
                <span class="badge bg-{{ $statusClass }}">
                    @if($shipment->status == 'new') جديدة
                    @elseif($shipment->status == 'in_transit') في الطريق
                    @elseif($shipment->status == 'delivered') تم التسليم
                    @else متأخرة
                    @endif
                </span>
            </div>
            <div class="col-md-3">
                <strong>تاريخ الإنشاء:</strong> {{ $shipment->created_at->format('Y-m-d') }}
            </div>
        </div>
    </div>
</div>

<div class="card shadow mt-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">خطوات التتبع</h5>
    </div>
    <div class="card-body">
        @if($steps->count() > 0)
            <div class="timeline">
                @foreach($steps as $index => $step)
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
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
                                <form action="{{ route('admin.shipments.steps.destroy', [$shipment, $step]) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه الخطوة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fa-solid fa-route fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">لا توجد خطوات تتبع</h5>
                <p class="text-muted">ابدأ بإضافة خطوة تتبع جديدة</p>
            </div>
        @endif
    </div>
</div>

<!-- Modal لإضافة خطوة جديدة -->
<div class="modal fade" id="addStepModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة خطوة تتبع جديدة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.shipments.steps.store', $shipment) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">الحالة</label>
                        <input type="text" class="form-control" id="status" name="status" required placeholder="مثال: تم استلام الشحنة">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">الموقع</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="مثال: الرياض، المملكة العربية السعودية">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">الوصف</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="وصف تفصيلي للخطوة"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="step_date" class="form-label">تاريخ الخطوة</label>
                        <input type="datetime-local" class="form-control" id="step_date" name="step_date">
                        <small class="text-muted">اتركها فارغة لاستخدام الوقت الحالي</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">إضافة الخطوة</button>
                </div>
            </form>
        </div>
    </div>
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
