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
        Schema::create('gioi_dans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->date('start_date');
            $table->date('end_date');
            $table->json('ordination_levels'); // Các giới phẩm được tổ chức
            $table->enum('status', ['upcoming', 'open', 'closed', 'completed'])->default('upcoming');
            $table->integer('max_participants')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gioi_dans');
    }
};
