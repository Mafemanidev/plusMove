<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder {
    public function run() {
        $provinces = [
            'Eastern Cape', 'Free State', 'Gauteng', 'KwaZulu-Natal',
            'Limpopo', 'Mpumalanga', 'North West', 'Northern Cape', 'Western Cape'
        ];

        foreach ($provinces as $province) {
            Warehouse::updateOrCreate(['name' => $province]);
        }
    }
}

