<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShipmentController extends Controller
{
    /**
     * عرض قائمة الشحنات
     */
    public function index()
    {
        $shipments = Shipment::with('customer')->latest()->paginate(10);
        return view('admin.shipments.index', compact('shipments'));
    }

    /**
     * عرض نموذج إنشاء شحنة جديدة
     */
    public function create()
    {
        $customers = Customer::all();
        $statuses = Shipment::STATUSES;
        return view('admin.shipments.create', compact('customers', 'statuses'));
    }

    /**
     * تخزين شحنة جديدة
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:' . implode(',', Shipment::STATUSES),
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ]);

        // توليد رقم تتبع فريد
        $trackingNumber = 'TRK-' . Str::upper(Str::random(10));

        Shipment::create(array_merge($validatedData, [
            'tracking_number' => $trackingNumber,
        ]));

        return redirect()->route('admin.shipments.index')
                         ->with('success', 'تم إضافة الشحنة بنجاح برقم التتبع: ' . $trackingNumber);
    }

    /**
     * عرض نموذج تعديل شحنة موجودة
     */
    public function edit(Shipment $shipment)
    {
        $customers = Customer::all();
        $statuses = Shipment::STATUSES;
        return view('admin.shipments.edit', compact('shipment', 'customers', 'statuses'));
    }

    /**
     * تحديث بيانات شحنة
     */
    public function update(Request $request, Shipment $shipment)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:' . implode(',', Shipment::STATUSES),
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ]);

        $shipment->update($validatedData);

        return redirect()->route('admin.shipments.index')
                         ->with('success', 'تم تحديث بيانات الشحنة بنجاح.');
    }

    /**
     * حذف شحنة
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return redirect()->route('admin.shipments.index')
                         ->with('success', 'تم حذف الشحنة بنجاح.');
    }
}
