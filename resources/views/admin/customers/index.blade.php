@extends('admin.layouts.admin')

@section('title', 'إدارة العملاء')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold text-dark">إدارة العملاء</h1>
    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i>إضافة عميل جديد
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow">
    <div class="card-body">
        @if($customers->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>رقم الهاتف</th>
                            <th>تاريخ التسجيل</th>
                            <th>عدد الشحنات</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td class="fw-bold">{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone ?? 'غير محدد' }}</td>
                                <td>{{ $customer->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $customer->shipments->count() }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا العميل؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
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
            
            {{ $customers->links() }}
        @else
            <div class="text-center py-5">
                <i class="fa-solid fa-users fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">لا توجد عملاء مسجلين</h5>
                <p class="text-muted">ابدأ بإضافة عميل جديد</p>
            </div>
        @endif
    </div>
</div>
@endsection
