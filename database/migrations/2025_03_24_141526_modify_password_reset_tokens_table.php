<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            $table->dropColumn('token'); // Remove token column
            $table->string('code', 6)->after('email'); // Add 6-digit code column
        });
    }

    public function down(): void {
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->string('token'); // Restore token column if rollback
        });
    }
};
