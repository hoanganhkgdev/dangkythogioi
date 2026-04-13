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
        Schema::create('tho_gioi_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Thông tin cá nhân (TN01)
            $table->string('full_name');
            $table->string('dharma_name')->nullable();
            $table->date('birth_date');
            $table->string('gender')->default('Nam');
            $table->string('id_card_number')->nullable();
            $table->date('id_card_date')->nullable();
            $table->string('id_card_place')->nullable();
            $table->string('native_place')->nullable(); // Quê quán
            $table->string('permanent_address')->nullable(); // Thường trú
            $table->string('current_residence')->nullable(); // Nơi ở hiện tại
            
            // Trình độ
            $table->string('education_level')->nullable(); // Văn hóa
            $table->string('buddhist_education')->nullable(); // Phật học
            
            // Quá trình tu học
            $table->date('ordain_date')->nullable(); // Ngày phát tâm
            $table->string('ordain_temple')->nullable(); // Nơi phát tâm
            $table->string('master_name')->nullable(); // Bổn sư
            $table->string('temple_name')->nullable(); // Chùa hiện tại
            
            // Thông tin đăng ký thọ giới (TN16-TN21)
            $table->string('ordination_level'); // Sa di, Tỳ kheo...
            $table->string('status')->default('pending');
            $table->string('scanned_form_path')->nullable();
            $table->string('certificate_id')->unique()->nullable();
            $table->timestamp('approved_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tho_gioi_applications');
    }
};
