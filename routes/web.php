<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ShipmentStepController;

/*
|--------------------------------------------------------------------------
| المسارات العامة (Public Routes)
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية ونموذج التتبع السريع
Route::get('/', function () {
    return view('welcome');
})->name('home');

// معالجة عملية التتبع العام وعرض التفاصيل
Route::post('/track', [TrackingController::class, 'track'])->name('track.shipment');
Route::get('/track/{tracking_number}', [TrackingController::class, 'showTracking'])->name('tracking.details');

// مسار إرسال استفسار جديد (لنموذج الاتصال)
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiry.store');

/*
|--------------------------------------------------------------------------
| مصادقة العملاء (Customer Authentication)
|--------------------------------------------------------------------------
*/

Route::prefix('customer')->name('customer.')->group(function () {
    // واجهات التسجيل والدخول
    Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'login']);

    // تفعيل مسارات التسجيل
    Route::get('/register', [CustomerAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'register']);

    // مسارات تحتاج لمصادقة العميل
    Route::middleware('auth:customer')->group(function () {
        Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [CustomerAuthController::class, 'dashboard'])->name('dashboard');
    });
});

/*
|--------------------------------------------------------------------------
| مصادقة وإدارة الإدارة (Admin Authentication & Management)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // مسارات المصادقة للإدارة
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // مسارات محمية للإدارة
    Route::middleware('auth')->group(function () {
        // لوحة التحكم وعرض الإحصائيات والتقارير
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/reports', [AdminAuthController::class, 'dashboard'])->name('reports'); // نستخدم لوحة التحكم كصفحة تقارير

        // مسارات CRUD للعملاء
        Route::resource('customers', CustomerController::class)->except(['show']);

        // مسارات CRUD للشحنات
        Route::resource('shipments', ShipmentController::class)->except(['show']);

        // مسارات إدارة خطوات التتبع المفصلة (Nested Routes)
        Route::prefix('shipments/{shipment}')->name('shipments.')->group(function () {
            Route::get('steps', [ShipmentStepController::class, 'index'])->name('steps.index');
            Route::post('steps', [ShipmentStepController::class, 'store'])->name('steps.store');
            Route::delete('steps/{step}', [ShipmentStepController::class, 'destroy'])->name('steps.destroy');
        });

        // مسارات الاستفسارات (القراءة والحذف)
        Route::resource('inquiries', InquiryController::class)->only(['index', 'destroy']);
    });
});
