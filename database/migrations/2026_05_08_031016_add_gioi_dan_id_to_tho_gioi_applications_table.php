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
        Schema::table('tho_gioi_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('tho_gioi_applications', 'gioi_dan_id')) {
                $table->foreignId('gioi_dan_id')->nullable()->constrained('gioi_dans')->nullOnDelete()->after('user_id');
            } else {
                $table->foreign('gioi_dan_id')->references('id')->on('gioi_dans')->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tho_gioi_applications', function (Blueprint $table) {
            $table->dropForeign(['gioi_dan_id']);
            $table->dropColumn('gioi_dan_id');
        });
    }
};
