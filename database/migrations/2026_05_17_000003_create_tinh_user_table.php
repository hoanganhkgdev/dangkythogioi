<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tinh_user', function (Blueprint $table) {
            $table->foreignId('tinh_id')->constrained('tinhs')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->primary(['tinh_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tinh_user');
    }
};
