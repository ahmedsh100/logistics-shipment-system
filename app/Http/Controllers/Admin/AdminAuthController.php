<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shipment; // استيراد نموذج الشحنة
use App\Models\Customer; // استيراد نموذج العميل
use App\Models\Inquiry;  // استيراد نموذج الاستفسار

class AdminAuthController extends Controller
{
    /**
     * عرض نموذج تسجيل الدخول للإدارة.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * معالجة محاولة تسجيل الدخول للإدارة.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'البيانات المُدخلة لا تتطابق مع سجلاتنا.',
        ])->onlyInput('email');
    }

    /**
     * عرض لوحة تحكم الإدارة (مع الإحصائيات الجديدة).
     */
    public function dashboard()
    {
        // 1. الإحصائيات الرئيسية (Card Metrics)
        $totalCustomers = Customer::count();
        $totalShipments = Shipment::count();
        $totalInquiries = Inquiry::count();

        // 2. إحصائيات الشحنات حسب الحالة
        $shipmentCounts = Shipment::select('status', \DB::raw('count(*) as count'))
                                  ->groupBy('status')
                                  ->pluck('count', 'status')
                                  ->all();

        // دمج الإحصائيات في مصفوفة واحدة
        $stats = [
            'totalCustomers' => $totalCustomers,
            'totalShipments' => $totalShipments,
            'totalInquiries' => $totalInquiries,
            'new' => $shipmentCounts['new'] ?? 0,
            'in_transit' => $shipmentCounts['in_transit'] ?? 0,
            'delivered' => $shipmentCounts['delivered'] ?? 0,
            'delayed' => $shipmentCounts['delayed'] ?? 0,
        ];


        return view('admin.dashboard', compact('stats'));
    }

    /**
     * تسجيل الخروج للإدارة.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
