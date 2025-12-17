<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::rename(
            'cache',
            'SedayuHS_543905_cache'
        );

         Schema::rename(
            'cache',
            'SedayuHS_543905_cache'
        );
    }


    public function down(): void
    {
        Schema::rename(
            'saya_123456_univ_pekerjaan',
            'pekerjaan'
        );
    }
};
