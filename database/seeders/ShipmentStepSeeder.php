<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shipment;
use App\Models\ShipmentStep;

class ShipmentStepSeeder extends Seeder
{
    public function run(): void
    {
        $shipments = Shipment::all();
        
        $stepTemplates = [
            [
                'status' => 'تم استلام الشحنة',
                'location' => 'مركز التوزيع الرئيسي - الرياض',
                'description' => 'تم استلام الشحنة من المرسل وتسجيلها في النظام',
            ],
            [
                'status' => 'الشحنة في طريقها',
                'location' => 'مركز التوزيع الفرعي - جدة',
                'description' => 'تم تحميل الشحنة على السيارة وبدأ عملية النقل',
            ],
            [
                'status' => 'الشحنة في التوزيع',
                'location' => 'منطقة التوزيع المحلية',
                'description' => 'الشحنة وصلت لمنطقة التوزيع وستتم عملية التسليم قريباً',
            ],
            [
                'status' => 'تم التسليم',
                'location' => 'عنوان المستلم',
                'description' => 'تم تسليم الشحنة بنجاح للمستلم',
            ],
            [
                'status' => 'تأخير في التسليم',
                'location' => 'مركز التوزيع',
                'description' => 'تم تأجيل التسليم بسبب عدم توفر المستلم في العنوان المحدد',
            ],
        ];

        foreach ($shipments as $shipment) {
            // إضافة خطوات عشوائية لكل شحنة
            $numSteps = rand(1, 4);
            $selectedSteps = array_rand($stepTemplates, min($numSteps, count($stepTemplates)));
            
            if (!is_array($selectedSteps)) {
                $selectedSteps = [$selectedSteps];
            }
            
            foreach ($selectedSteps as $stepIndex) {
                $step = $stepTemplates[$stepIndex];
                
                ShipmentStep::create([
                    'shipment_id' => $shipment->id,
                    'status' => $step['status'],
                    'location' => $step['location'],
                    'description' => $step['description'],
                    'step_date' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}
