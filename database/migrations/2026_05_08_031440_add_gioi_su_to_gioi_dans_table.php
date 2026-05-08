<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('gioi_dans', function (Blueprint $table) {
            $table->string('hoa_thuong_dan_dau')->nullable()->after('description');
            $table->string('yet_ma_a_xa_le')->nullable()->after('hoa_thuong_dan_dau');
            $table->string('giao_tho_a_xa_le')->nullable()->after('yet_ma_a_xa_le');
            $table->json('ton_chung')->nullable()->after('giao_tho_a_xa_le'); // [{ordinal: 'Đệ nhất', name: '...'}]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gioi_dans', function (Blueprint $table) {
            $table->dropColumn(['hoa_thuong_dan_dau', 'yet_ma_a_xa_le', 'giao_tho_a_xa_le', 'ton_chung']);
        });
    }
};
