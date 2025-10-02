<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;

class TrackingController extends Controller
{
    // معالجة نموذج التتبع من الصفحة الرئيسية (POST)
    public function track(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string|max:255',
        ]);

        $trackingNumber = $request->input('tracking_number');

        return redirect()->route('tracking.details', $trackingNumber);
    }

    // عرض تفاصيل التتبع بناءً على رقم التتبع (GET)
    public function showTracking(string $tracking_number)
    {
        $shipment = Shipment::where('tracking_number', $tracking_number)
                            ->with('steps')
                            ->first();

        // يجب أن نرسل الشحنة وخطوات التتبع إلى الواجهة
        return view('tracking.details', compact('shipment'));
    }
}
