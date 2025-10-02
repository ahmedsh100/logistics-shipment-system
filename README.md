# نظام تتبع الشحنات - Logistics Shipment System

## نظرة عامة
نظام إدارة وتتبع الشحنات مبني بـ Laravel 10، يوفر واجهة سهلة للعملاء لتتبع شحناتهم ولوحة تحكم شاملة للإدارة.

## المميزات الرئيسية

### للعملاء
- ✅ تتبع الشحنات برقم التتبع
- ✅ تسجيل الدخول وإنشاء حساب جديد
- ✅ لوحة تحكم شخصية لعرض الشحنات
- ✅ إرسال استفسارات للدعم

### للإدارة
- ✅ لوحة تحكم شاملة مع إحصائيات مفصلة
- ✅ إدارة العملاء (إضافة، تعديل، حذف)
- ✅ إدارة الشحنات (إضافة، تعديل، حذف)
- ✅ إدارة خطوات التتبع المفصلة
- ✅ إدارة استفسارات العملاء
- ✅ تقارير وإحصائيات شاملة

## التقنيات المستخدمة
- **Laravel 10** - إطار العمل الأساسي
- **PHP 8.1+** - لغة البرمجة
- **MySQL** - قاعدة البيانات
- **Bootstrap 5 (RTL)** - واجهة المستخدم
- **FontAwesome** - الأيقونات
- **Laravel Sanctum** - المصادقة

## التثبيت والتشغيل

### المتطلبات
- PHP 8.1 أو أحدث
- Composer
- MySQL 5.7 أو أحدث
- Node.js و NPM (للبناء)

### خطوات التثبيت

1. **استنساخ المشروع**
```bash
git clone <repository-url>
cd logistics-shipment-system
```

2. **تثبيت التبعيات**
```bash
composer install
npm install
```

3. **إعداد البيئة**
```bash
cp .env.example .env
php artisan key:generate
```

4. **تكوين قاعدة البيانات**
عدّل ملف `.env` وأضف بيانات قاعدة البيانات:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=logistics_shipment_system
DB_USERNAME=root
DB_PASSWORD=
```

5. **تشغيل الهجرات والبذور**
```bash
php artisan migrate --seed
```

6. **بناء الأصول**
```bash
npm run build
```

7. **تشغيل الخادم**
```bash
php artisan serve
```

## البيانات التجريبية

بعد تشغيل البذور، ستجد:

### المستخدم الإداري
- **البريد الإلكتروني:** admin@example.com
- **كلمة المرور:** admin123

### العملاء التجريبيون
- جميع العملاء يستخدمون كلمة المرور: `password123`
- أمثلة على البريد الإلكتروني: ahmed@example.com, fatima@example.com

## هيكل المشروع

```
app/
├── Http/Controllers/
│   ├── Admin/          # كونترولرات الإدارة
│   ├── CustomerAuthController.php
│   ├── TrackingController.php
│   └── InquiryController.php
├── Models/
│   ├── Customer.php
│   ├── Shipment.php
│   ├── ShipmentStep.php
│   ├── Inquiry.php
│   └── User.php
└── ...

resources/views/
├── admin/              # صفحات الإدارة
├── customer/           # صفحات العملاء
├── tracking/           # صفحات التتبع
├── layouts/            # القوالب
└── ...

database/
├── migrations/         # هجرات قاعدة البيانات
└── seeders/           # بذور البيانات
```

## المسارات الرئيسية

### العامة
- `/` - الصفحة الرئيسية والتتبع السريع
- `/track/{number}` - عرض تفاصيل التتبع

### العملاء
- `/customer/login` - تسجيل دخول العملاء
- `/customer/register` - تسجيل عميل جديد
- `/customer/dashboard` - لوحة تحكم العميل

### الإدارة
- `/admin/login` - تسجيل دخول الإدارة
- `/admin/dashboard` - لوحة تحكم الإدارة
- `/admin/shipments` - إدارة الشحنات
- `/admin/customers` - إدارة العملاء
- `/admin/inquiries` - استفسارات العملاء

## المطور
تم تطوير هذا النظام باستخدام أفضل الممارسات في Laravel مع دعم كامل للغة العربية وواجهة مستخدم متجاوبة.

## الترخيص
هذا المشروع مرخص تحت رخصة MIT.
