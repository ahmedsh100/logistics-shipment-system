@extends('layouts.main')

@section('title', 'تتبع الشحنة')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h1 class="mb-4 text-center fw-bold text-dark">تفاصيل تتبع الشحنة</h1>

            @if ($shipment)
                <div class="card shadow-lg mb-5">
                    <div class="card-header bg-primary text-white fw-bold d-flex justify-content-between align-items-center">
                        <div>
                            رقم التتبع: {{ $shipment->tracking_number }}
                        </div>
                        <div class="h5 mb-0">
                            الحالة الحالية:
                            @php
                                $statusClass = match($shipment->status) {
                                    'delivered' => 'success',
                                    'in_transit' => 'info text-dark',
                                    'delayed' => 'danger',
                                    default => 'secondary',
                                };
                                $statusText = match($shipment->status) {
                                    'new' => 'قيد التسجيل',
                                    'in_transit' => 'في الطريق',
                                    'delivered' => 'تم التوصيل',
                                    'delayed' => 'متأخرة',
                                    default => $shipment->status,
                                };
                            @endphp
                            <span class="badge bg-{{ $statusClass }} p-2">{{ $statusText }}</span>
                        </div>
                    </div>
                    <div class="card-body p-4 text-end">
                        <p><strong>الوصف:</strong> {{ $shipment->description ?? 'لا يوجد وصف.' }}</p>
                        <p><strong>قيمة الشحنة:</strong> {{ number_format($shipment->amount, 2) ?? '---' }} SAR</p>
                        <p><strong>تاريخ آخر تحديث:</strong> {{ $shipment->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>

                {{-- سجل التتبع المفصل (Timeline) --}}
                <h2 class="fw-bold mb-4 text-dark text-center">سجل التتبع الزمني</h2>
                @if ($shipment->steps->isEmpty())
                    <div class="alert alert-info text-center">لم يتم تسجيل خطوات تتبع مفصلة لهذه الشحنة بعد.</div>
                @else
                    <ul class="timeline">
                        @foreach ($shipment->steps as $step)
                            <li class="{{ $loop->first ? 'active' : '' }}">
                                <div class="timeline-badge {{ $loop->first ? 'bg-primary' : 'bg-secondary' }}"><i class="fa-solid fa-clock"></i></div>
                                <div class="timeline-panel shadow-sm border p-4 rounded mb-4">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title fw-bold text-dark">
                                            {{ $step->status }}
                                        </h4>
                                        <p><small class="text-muted"><i class="fa-regular fa-calendar-alt me-1"></i> {{ $step->created_at->format('Y-m-d H:i A') }}</small></p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>{{ $step->notes ?? 'لا يوجد تفاصيل إضافية.' }}</p>
                                        @if($step->location)
                                            <span class="badge bg-light text-dark border border-secondary"><i class="fa-solid fa-map-marker-alt me-1"></i> الموقع: {{ $step->location }}</span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

            @else
                <div class="alert alert-danger text-center shadow">
                    عذراً، لم يتم العثور على شحنة مرتبطة برقم التتبع هذا.
                </div>
            @endif

            <div class="text-center mt-5">
                <a href="{{ route('home') }}" class="btn btn-secondary btn-lg"><i class="fa-solid fa-arrow-right me-2"></i> العودة للصفحة الرئيسية</a>
            </div>
        </div>
    </div>
</div>

<style>
/* تخصيص بسيط لشكل الجدول الزمني (Timeline) */
.timeline {
    list-style: none;
    padding: 20px 0 20px;
    position: relative;
    direction: rtl;
}
.timeline:before {
    top: 0;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 3px;
    background-color: #eeeeee;
    right: 50%;
    margin-right: -1.5px;
}
.timeline > li {
    margin-bottom: 20px;
    position: relative;
}
.timeline > li:before, .timeline > li:after {
    content: " ";
    display: table;
}
.timeline > li:after {
    clear: both;
}
.timeline > li > .timeline-panel {
    width: 45%;
    float: right;
    border: 1px solid #d4d4d4;
    position: relative;
}
.timeline > li > .timeline-badge {
    color: #fff;
    width: 50px;
    height: 50px;
    line-height: 50px;
    font-size: 1.4em;
    text-align: center;
    position: absolute;
    top: 16px;
    right: 50%;
    margin-right: -25px;
    z-index: 100;
    border-radius: 50%;
}
.timeline > li.active > .timeline-panel {
    border-color: #0d6efd;
    background-color: #e9f0ff;
}
.timeline > li.active > .timeline-panel:after {
    border-right-width: 0;
    border-left-width: 10px;
    left: -10px;
    right: auto;
}
.timeline > li.active > .timeline-panel:before {
    border-right-width: 0;
    border-left-width: 12px;
    left: -12px;
    right: auto;
}
.timeline > li > .timeline-panel:after {
    border-color: transparent;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-right: 0 solid #fff;
    border-left: 10px solid #fff;
    position: absolute;
    top: 26px;
    left: -10px;
    right: auto;
    content: " ";
    display: inline-block;
}
.timeline > li > .timeline-panel:before {
    border-color: transparent;
    border-top: 11px solid transparent;
    border-bottom: 11px solid transparent;
    border-right: 0 solid #ccc;
    border-left: 11px solid #ccc;
    position: absolute;
    top: 25px;
    left: -11px;
    right: auto;
    content: " ";
    display: inline-block;
}
/* تنسيق العناصر الفردية للTimeline */
.timeline-title {
    margin-top: 0;
    color: inherit;
}
@media (max-width: 991px) {
    .timeline:before {
        right: 20px;
        margin-right: 0;
    }
    .timeline > li > .timeline-panel {
        width: calc(100% - 60px);
        float: right;
    }
    .timeline > li > .timeline-badge {
        right: 20px;
        margin-right: -25px;
    }
    .timeline > li > .timeline-panel:before, .timeline > li > .timeline-panel:after {
        border-right-width: 0;
        border-left-width: 10px;
        left: -10px;
        right: auto;
    }
}
</style>
@endsection
