<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\ShipmentStep;
use Illuminate\Http\Request;

class ShipmentStepController extends Controller
{
    /**
     * عرض خطوات التتبع لشحنة معينة
     */
    public function index(Shipment $shipment)
    {
        $steps = $shipment->steps()->orderBy('created_at', 'desc')->get();
        return view('admin.shipments.steps.index', compact('shipment', 'steps'));
    }

    /**
     * إضافة خطوة تتبع جديدة
     */
    public function store(Request $request, Shipment $shipment)
    {
        $validatedData = $request->validate([
            'status' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'step_date' => 'nullable|date',
        ]);

        $shipment->steps()->create(array_merge($validatedData, [
            'step_date' => $validatedData['step_date'] ?? now(),
        ]));

        return redirect()->route('admin.shipments.steps.index', $shipment)
                         ->with('success', 'تم إضافة خطوة التتبع بنجاح.');
    }

    /**
     * حذف خطوة تتبع
     */
    public function destroy(Shipment $shipment, ShipmentStep $step)
    {
        $step->delete();
        return redirect()->route('admin.shipments.steps.index', $shipment)
                         ->with('success', 'تم حذف خطوة التتبع بنجاح.');
    }
}
