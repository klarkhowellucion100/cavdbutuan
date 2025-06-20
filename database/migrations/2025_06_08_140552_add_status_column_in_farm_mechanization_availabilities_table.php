<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('farm_mechanization_availabilities', function (Blueprint $table) {
            $table->bigInteger('status')->nullable()->after('time_to');
        });
    }

    public function down(): void
    {
        Schema::table('farm_mechanization_availabilities', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
