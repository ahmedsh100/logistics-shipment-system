@extends('admin.layouts.admin')

@section('title', 'إدارة الاستفسارات')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold text-dark">إدارة الاستفسارات</h1>
    <span class="badge bg-info fs-6">إجمالي الاستفسارات: {{ $inquiries->total() }}</span>
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
        @if($inquiries->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الرسالة</th>
                            <th>تاريخ الإرسال</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inquiries as $inquiry)
                            <tr>
                                <td>{{ $inquiry->id }}</td>
                                <td class="fw-bold">{{ $inquiry->name }}</td>
                                <td>
                                    <a href="mailto:{{ $inquiry->email }}" class="text-decoration-none">
                                        {{ $inquiry->email }}
                                    </a>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 300px;" title="{{ $inquiry->message }}">
                                        {{ $inquiry->message }}
                                    </div>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $inquiry->created_at->format('Y-m-d H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#inquiryModal{{ $inquiry->id }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الاستفسار؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Modal لعرض تفاصيل الاستفسار -->
                            <div class="modal fade" id="inquiryModal{{ $inquiry->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">تفاصيل الاستفسار</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <strong>الاسم:</strong> {{ $inquiry->name }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>البريد الإلكتروني:</strong> 
                                                    <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <strong>تاريخ الإرسال:</strong> {{ $inquiry->created_at->format('Y-m-d H:i:s') }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <strong>الرسالة:</strong>
                                                    <div class="mt-2 p-3 bg-light rounded">
                                                        {{ $inquiry->message }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="mailto:{{ $inquiry->email }}" class="btn btn-primary">
                                                <i class="fa-solid fa-envelope me-2"></i>الرد على البريد الإلكتروني
                                            </a>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{ $inquiries->links() }}
        @else
            <div class="text-center py-5">
                <i class="fa-solid fa-question-circle fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">لا توجد استفسارات</h5>
                <p class="text-muted">لم يتم إرسال أي استفسارات من العملاء بعد</p>
            </div>
        @endif
    </div>
</div>
@endsection
