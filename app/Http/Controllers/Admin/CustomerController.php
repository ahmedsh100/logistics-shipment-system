<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * عرض قائمة العملاء
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * عرض نموذج إنشاء عميل جديد
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * تخزين عميل جديد
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Customer::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('admin.customers.index')
                         ->with('success', 'تم إضافة العميل بنجاح.');
    }

    /**
     * عرض نموذج تعديل عميل موجود
     */
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * تحديث بيانات عميل
     */
    public function update(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $customer->name = $validatedData['name'];
        $customer->email = $validatedData['email'];
        $customer->phone = $validatedData['phone'];

        if (!empty($validatedData['password'])) {
            $customer->password = Hash::make($validatedData['password']);
        }

        $customer->save();

        return redirect()->route('admin.customers.index')
                         ->with('success', 'تم تحديث بيانات العميل بنجاح.');
    }

    /**
     * حذف عميل
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')
                         ->with('success', 'تم حذف العميل بنجاح.');
    }
}
