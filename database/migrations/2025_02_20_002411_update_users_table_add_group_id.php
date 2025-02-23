<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role'); // Remove the role column
            $table->foreignId('group_id')->nullable()->constrained('groups')->onDelete('set null');
        });
    }

    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable(); // Re-add role column if rolled back
            $table->dropForeign(['group_id']);
            $table->dropColumn('group_id');
        });
    }
};
