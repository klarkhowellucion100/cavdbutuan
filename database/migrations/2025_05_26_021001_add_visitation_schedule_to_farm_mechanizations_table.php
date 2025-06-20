<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('farm_mechanizations', function (Blueprint $table) {
            $table->date('visitation_schedule')->nullable()->after('proposed_schedule')->index();
        });
    }

    public function down(): void
    {
        Schema::table('farm_mechanizations', function (Blueprint $table) {
            $table->dropIndex(['visitation_schedule']);
            $table->dropColumn('visitation_schedule');
        });
    }
};
