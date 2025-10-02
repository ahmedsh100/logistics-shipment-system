<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // إنشاء مستخدم إداري افتراضي
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
        ]);

        // تشغيل Seeders للبيانات التجريبية
        $this->call([
            CustomerSeeder::class,
            ShipmentSeeder::class,
            ShipmentStepSeeder::class,
            InquirySeeder::class,
        ]);
    }
}
