<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\Shipment;

class CustomerAuthController extends Controller
{
    // عرض نموذج تسجيل دخول العملاء
    public function showLoginForm()
    {
        return view('customer.login');
    }

    // معالجة تسجيل دخول العملاء
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('customer')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('customer.dashboard'));
        }

        return back()->withErrors([
            'email' => 'البيانات المُدخلة غير صحيحة لحساب العميل.',
        ])->onlyInput('email');
    }

    // عرض نموذج تسجيل عميل جديد
    public function showRegistrationForm()
    {
        return view('customer.register');
    }

    // معالجة تسجيل عميل جديد
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $customer = Customer::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // تسجيل دخول العميل تلقائياً بعد التسجيل
        Auth::guard('customer')->login($customer);

        return redirect()->route('customer.dashboard')->with('success', 'تم إنشاء حسابك بنجاح!');
    }

    // عرض لوحة تحكم العميل
    public function dashboard()
    {
        $customer = Auth::guard('customer')->user();
        // جلب آخر 10 شحنات للعميل
        $shipments = $customer->shipments()->latest()->take(10)->get();

        return view('customer.dashboard', compact('customer', 'shipments'));
    }

    // تسجيل خروج العميل
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
