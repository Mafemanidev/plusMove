<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tracking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('status'); // e.g., 'Order Created', 'Shipped', 'Out for Delivery'
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('tracking_details');
    }
};

