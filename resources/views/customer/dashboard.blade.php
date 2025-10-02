@extends('layouts.main')

@section('title', 'لوحة تحكم العميل')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 fw-bold text-dark text-center">مرحباً بك، {{ $customer->name }}!</h1>
    <p class="lead text-center text-muted">هنا يمكنك متابعة آخر شحناتك وتفاصيل حسابك.</p>

    <div class="card shadow-lg mb-5 rounded-3">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="fa-solid fa-box-open me-2"></i> شحناتي الأخيرة (آخر 10 شحنات)
        </div>
        <div class="card-body p-0">
            @if($shipments->isEmpty())
                <div class="alert alert-warning m-3 text-center">
                    لا توجد شحنات مسجلة على حسابك حتى الآن.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>رقم التتبع</th>
                                <th>الوصف</th>
                                <th>القيمة (SAR)</th>
                                <th>الحالة</th>
                                <th>تاريخ الإنشاء</th>
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shipments as $shipment)
                                <tr>
                                    <td class="fw-bold">{{ $shipment->tracking_number }}</td>
                                    <td>{{ Str::limit($shipment->description, 30) }}</td>
                                    <td>{{ number_format($shipment->amount, 2) }}</td>
                                    <td>
                                        @php
                                            $statusClass = match($shipment->status) {
                                                'delivered' => 'success',
                                                'in_transit' => 'info text-dark',
                                                'delayed' => 'danger',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $statusClass }}">{{ $shipment->status }}</span>
                                    </td>
                                    <td>{{ $shipment->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('tracking.details', $shipment->tracking_number) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-eye me-1"></i> تتبع
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="text-center">
        <form action="{{ route('customer.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger btn-lg"><i class="fa-solid fa-sign-out-alt me-2"></i> تسجيل الخروج</button>
        </form>
    </div>
</div>
@endsection
