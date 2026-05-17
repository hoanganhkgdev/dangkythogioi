<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gioi_dans', function (Blueprint $table) {
            $table->foreignId('tinh_id')->nullable()->constrained('tinhs')->nullOnDelete()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('gioi_dans', function (Blueprint $table) {
            $table->dropForeign(['tinh_id']);
            $table->dropColumn('tinh_id');
        });
    }
};
