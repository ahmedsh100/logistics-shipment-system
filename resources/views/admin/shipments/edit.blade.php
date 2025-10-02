@extends('admin.layouts.admin')

@section('title', 'تعديل الشحنة')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold text-dark">تعديل الشحنة: {{ $shipment->tracking_number }}</h1>
    <a href="{{ route('admin.shipments.index') }}" class="btn btn-outline-secondary">
        <i class="fa-solid fa-arrow-right me-2"></i>العودة للقائمة
    </a>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('admin.shipments.update', $shipment) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">العميل</label>
                        <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" required>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id', $shipment->customer_id) == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} ({{ $customer->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">حالة الشحنة</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ old('status', $shipment->status) == $status ? 'selected' : '' }}>
                                    @if($status == 'new') جديدة
                                    @elseif($status == 'in_transit') في الطريق
                                    @elseif($status == 'delivered') تم التسليم
                                    @else متأخرة
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="amount" class="form-label">المبلغ (ريال)</label>
                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $shipment->amount) }}" required>
                        @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description" class="form-label">وصف الشحنة</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $shipment->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.shipments.index') }}" class="btn btn-secondary">إلغاء</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save me-2"></i>حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
