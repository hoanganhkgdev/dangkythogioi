<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')
            ->where('role', 'quan_ly')
            ->update(['role' => 'quan_ly_gioi_dan']);
    }

    public function down(): void
    {
        DB::table('users')
            ->where('role', 'quan_ly_gioi_dan')
            ->update(['role' => 'quan_ly']);
    }
};
