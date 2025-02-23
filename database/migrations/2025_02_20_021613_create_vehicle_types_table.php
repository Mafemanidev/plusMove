<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('vehicle_types');
    }
};
