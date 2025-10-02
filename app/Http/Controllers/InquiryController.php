<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * تخزين استفسار جديد من النموذج العام
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        Inquiry::create($validatedData);

        return redirect()->route('home')
                         ->with('success_inquiry', 'تم إرسال استفسارك بنجاح. سنتواصل معك قريباً.');
    }
}
