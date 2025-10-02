@extends('admin.layouts.admin')

@section('title', 'إدارة الشحنات')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="fw-bold text-dark mb-2">
            <i class="fa-solid fa-box-open text-primary me-3"></i>
            إدارة الشحنات
        </h1>
        <p class="text-muted mb-0">إدارة جميع الشحنات وتتبع حالتها</p>
    </div>
    <a href="{{ route('admin.shipments.create') }}" class="btn btn-primary btn-lg">
        <i class="fa-solid fa-plus me-2"></i>إضافة شحنة جديدة
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- إحصائيات سريعة --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <i class="fa-solid fa-box fa-2x mb-2"></i>
                <h4 class="mb-0">{{ $shipments->total() }}</h4>
                <small>إجمالي الشحنات</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <i class="fa-solid fa-check-circle fa-2x mb-2"></i>
                <h4 class="mb-0">{{ $shipments->where('status', 'delivered')->count() }}</h4>
                <small>تم التسليم</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <i class="fa-solid fa-truck fa-2x mb-2"></i>
                <h4 class="mb-0">{{ $shipments->where('status', 'in_transit')->count() }}</h4>
                <small>في الطريق</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body text-center">
                <i class="fa-solid fa-exclamation-triangle fa-2x mb-2"></i>
                <h4 class="mb-0">{{ $shipments->where('status', 'delayed')->count() }}</h4>
                <small>متأخرة</small>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($shipments->count() > 0)
            {{-- شريط البحث والفلترة --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fa-solid fa-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="البحث في الشحنات...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">جميع الحالات</option>
                        <option value="new">جديدة</option>
                        <option value="in_transit">في الطريق</option>
                        <option value="delivered">تم التسليم</option>
                        <option value="delayed">متأخرة</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-primary w-100">
                        <i class="fa-solid fa-filter me-2"></i>فلترة
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>رقم التتبع</th>
                            <th>العميل</th>
                            <th>الوصف</th>
                            <th class="text-center">المبلغ</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">تاريخ الإنشاء</th>
                            <th class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shipments as $shipment)
                            <tr class="table-row-hover">
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">{{ $shipment->id }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-barcode text-primary me-2"></i>
                                        <span class="fw-bold text-primary">{{ $shipment->tracking_number }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            {{ substr($shipment->customer->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $shipment->customer->name }}</div>
                                            <small class="text-muted">{{ $shipment->customer->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 200px;" title="{{ $shipment->description }}">
                                        {{ $shipment->description ?: 'لا يوجد وصف' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="fw-bold text-success">{{ number_format($shipment->amount, 2) }} ريال</span>
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusConfig = match($shipment->status) {
                                            'delivered' => ['class' => 'success', 'icon' => 'check-circle'],
                                            'in_transit' => ['class' => 'warning', 'icon' => 'truck'],
                                            'delayed' => ['class' => 'danger', 'icon' => 'clock'],
                                            default => ['class' => 'secondary', 'icon' => 'plus-circle'],
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusConfig['class'] }} d-flex align-items-center justify-content-center" style="width: fit-content; margin: 0 auto;">
                                        <i class="fa-solid fa-{{ $statusConfig['icon'] }} me-1"></i>
                                        @if($shipment->status == 'new') جديدة
                                        @elseif($shipment->status == 'in_transit') في الطريق
                                        @elseif($shipment->status == 'delivered') تم التسليم
                                        @else متأخرة
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div>
                                        <div class="fw-bold">{{ $shipment->created_at->format('Y-m-d') }}</div>
                                        <small class="text-muted">{{ $shipment->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.shipments.steps.index', $shipment) }}" 
                                           class="btn btn-sm btn-outline-info" 
                                           title="إدارة خطوات التتبع"
                                           data-bs-toggle="tooltip">
                                            <i class="fa-solid fa-route"></i>
                                        </a>
                                        <a href="{{ route('admin.shipments.edit', $shipment) }}" 
                                           class="btn btn-sm btn-outline-primary"
                                           data-bs-toggle="tooltip"
                                           title="تعديل الشحنة">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.shipments.destroy', $shipment) }}" 
                                              method="POST" 
                                              class="d-inline" 
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذه الشحنة؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip"
                                                    title="حذف الشحنة">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    عرض {{ $shipments->firstItem() }} إلى {{ $shipments->lastItem() }} من {{ $shipments->total() }} نتيجة
                </div>
                <div>
                    {{ $shipments->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="fa-solid fa-box-open fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted mb-3">لا توجد شحنات مسجلة</h4>
                    <p class="text-muted mb-4">ابدأ بإضافة شحنة جديدة لإدارة عمليات التتبع</p>
                    <a href="{{ route('admin.shipments.create') }}" class="btn btn-primary btn-lg">
                        <i class="fa-solid fa-plus me-2"></i>إضافة شحنة جديدة
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
.avatar-sm {
    width: 40px;
    height: 40px;
    font-size: 14px;
    font-weight: bold;
}

.table-row-hover:hover {
    background-color: rgba(0, 123, 255, 0.05);
    transform: scale(1.01);
    transition: all 0.3s ease;
}

.empty-state {
    padding: 60px 20px;
}

.card.bg-primary,
.card.bg-success,
.card.bg-warning,
.card.bg-danger {
    border: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.card.bg-primary:hover,
.card.bg-success:hover,
.card.bg-warning:hover,
.card.bg-danger:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.btn-group .btn {
    margin: 0 2px;
}

@media (max-width: 768px) {
    .d-flex.justify-content-between {
        flex-direction: column;
        align-items: stretch !important;
    }
    
    .d-flex.justify-content-between > div:first-child {
        margin-bottom: 20px;
    }
    
    .table-responsive {
        font-size: 14px;
    }
    
    .btn-group {
        flex-direction: column;
    }
    
    .btn-group .btn {
        margin: 1px 0;
    }
}
</style>

<script>
// تفعيل tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection
