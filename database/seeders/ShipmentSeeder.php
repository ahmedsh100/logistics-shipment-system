<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shipment;
use App\Models\Customer;
use Illuminate\Support\Str;

class ShipmentSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();
        $statuses = ['new', 'in_transit', 'delivered', 'delayed'];
        
        $descriptions = [
            'شحنة إلكترونيات - هاتف ذكي',
            'أجهزة منزلية - ثلاجة',
            'ملابس ومستلزمات شخصية',
            'كتب وأدوات تعليمية',
            'مستلزمات طبية',
            'أدوات رياضية',
            'مجوهرات وعطور',
            'طعام ومشروبات',
        ];

        for ($i = 0; $i < 20; $i++) {
            Shipment::create([
                'tracking_number' => 'TRK-' . Str::upper(Str::random(10)),
                'customer_id' => $customers->random()->id,
                'status' => $statuses[array_rand($statuses)],
                'amount' => rand(50, 5000),
                'description' => $descriptions[array_rand($descriptions)],
            ]);
        }
    }
}
