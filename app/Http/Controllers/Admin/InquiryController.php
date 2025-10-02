<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * عرض قائمة الاستفسارات
     */
    public function index()
    {
        $inquiries = Inquiry::latest()->paginate(10);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    /**
     * حذف استفسار
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')
                         ->with('success', 'تم حذف الاستفسار بنجاح.');
    }
}
