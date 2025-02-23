<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade')->after('num_packages');
        });
    }

    public function down() {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['warehouse_id']); // Remove foreign key constraint
            $table->dropColumn('warehouse_id'); // Remove column
        });
    }
};
