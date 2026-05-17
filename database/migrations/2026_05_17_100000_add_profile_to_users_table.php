<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('dharma_name')->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->string('gender')->nullable()->after('phone');
            $table->date('birth_date')->nullable()->after('gender');
            $table->string('id_card_number')->nullable()->after('birth_date');
            $table->string('native_place')->nullable()->after('id_card_number');
            $table->text('permanent_address')->nullable()->after('native_place');
            $table->text('current_residence')->nullable()->after('permanent_address');
            $table->string('education_level')->nullable()->after('current_residence');
            $table->string('buddhist_education')->nullable()->after('education_level');
            $table->date('ordain_date')->nullable()->after('buddhist_education');
            $table->string('ordain_temple')->nullable()->after('ordain_date');
            $table->string('master_name')->nullable()->after('ordain_temple');
            $table->string('temple_name')->nullable()->after('master_name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'dharma_name', 'phone', 'gender', 'birth_date', 'id_card_number',
                'native_place', 'permanent_address', 'current_residence',
                'education_level', 'buddhist_education', 'ordain_date',
                'ordain_temple', 'master_name', 'temple_name',
            ]);
        });
    }
};
