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
            $table->date('sa_di_ordain_date')->nullable()->after('ordain_temple');
            $table->string('sa_di_gioi_dan')->nullable()->after('sa_di_ordain_date');
        });
    }

    public function down(): void
    {
        Schema::table('tho_gioi_applications', function (Blueprint $table) {
            $table->dropColumn(['sa_di_ordain_date', 'sa_di_gioi_dan']);
        });
    }
};
