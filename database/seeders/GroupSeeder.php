<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder {
    public function run() {
        Group::updateOrCreate(['name' => 'Admin']);
        Group::updateOrCreate(['name' => 'Driver']);
        Group::updateOrCreate(['name' => 'Customer']);
    }
}

