<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'name' => 'أحمد محمد السعد',
                'email' => 'ahmed@example.com',
                'phone' => '0501234567',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'فاطمة علي النور',
                'email' => 'fatima@example.com',
                'phone' => '0507654321',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'محمد عبدالله الشريف',
                'email' => 'mohammed@example.com',
                'phone' => '0509876543',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'نورا سعد الدوسري',
                'email' => 'nora@example.com',
                'phone' => '0504567890',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'خالد إبراهيم الغامدي',
                'email' => 'khalid@example.com',
                'phone' => '0503210987',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
