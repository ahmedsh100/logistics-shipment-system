<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inquiry;

class InquirySeeder extends Seeder
{
    public function run(): void
    {
        $inquiries = [
            [
                'name' => 'سارة أحمد',
                'email' => 'sara@example.com',
                'message' => 'أريد الاستفسار عن تكلفة شحن طرد إلى الدمام. هل يمكنكم تقديم عرض سعر؟',
            ],
            [
                'name' => 'عبدالله محمد',
                'email' => 'abdullah@example.com',
                'message' => 'متى ستصل شحنتي رقم TRK-ABC123؟ لقد تم تأجيلها عدة مرات.',
            ],
            [
                'name' => 'مريم السعد',
                'email' => 'mariam@example.com',
                'message' => 'هل تقدمون خدمة التوصيل السريع؟ وما هي المدن المشمولة؟',
            ],
            [
                'name' => 'خالد العتيبي',
                'email' => 'khalid@example.com',
                'message' => 'أريد تتبع شحنتي ولكن لا أجدها في النظام. رقم التتبع: TRK-XYZ789',
            ],
            [
                'name' => 'نورا الغامدي',
                'email' => 'nora@example.com',
                'message' => 'شكراً لكم على الخدمة الممتازة. هل يمكنني الحصول على خصم للشحنات المستقبلية؟',
            ],
            [
                'name' => 'محمد الدوسري',
                'email' => 'mohammed@example.com',
                'message' => 'أحتاج إلى شحن طرد هام جداً خلال 24 ساعة. هل هذا ممكن؟',
            ],
        ];

        foreach ($inquiries as $inquiry) {
            Inquiry::create($inquiry);
        }
    }
}
