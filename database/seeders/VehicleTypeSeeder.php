<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class VehicleTypeSeeder extends Seeder {
    public function run() {
        $types = ['Motorcycle', 'Car', 'Van', 'Truck'];

        foreach ($types as $type) {
            VehicleType::updateOrCreate(['type' => $type]);
        }
    }
}
