<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('status_progress', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Status name
            $table->timestamps();
        });

        //  Insert Default Tracking Statuses
        DB::table('status_progress')->insert([
            ['name' => 'Delivery Picked Up'],
            ['name' => 'On the Way'],
            ['name' => 'Customer Received'],
            ['name' => 'Customer Signed'],
            ['name' => 'Failed to Deliver']
        ]);
    }

    public function down() {
        Schema::dropIfExists('status_progress');
    }
};
