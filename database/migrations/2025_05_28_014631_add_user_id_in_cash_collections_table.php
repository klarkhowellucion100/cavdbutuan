<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('farm_mechanization_cash_collections', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::table('farm_mechanization_cash_collections', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropIndex(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
