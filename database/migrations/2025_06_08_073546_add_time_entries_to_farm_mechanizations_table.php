<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('farm_mechanizations', function (Blueprint $table) {
            $table->time('time_from')->nullable();
            $table->time('time_to')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('farm_mechanizations', function (Blueprint $table) {
            $table->dropColumn(['time_from', 'time_to']);
        });
    }
};
