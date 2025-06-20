<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('farm_mechanization_cash_collections', function (Blueprint $table) {
            $table->bigInteger('issuance_officer_id')->nullable()->after('fees_charge')->index();
        });
    }

    public function down(): void
    {
        Schema::table('farm_mechanization_cash_collections', function (Blueprint $table) {
            $table->dropIndex(['issuance_officer_id']);
            $table->dropColumn('issuance_officer_id');
        });
    }
};
