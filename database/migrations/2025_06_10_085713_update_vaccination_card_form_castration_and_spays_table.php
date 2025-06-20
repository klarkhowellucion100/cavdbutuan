<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('castration_and_spays', function (Blueprint $table) {
            $table->string('vaccination_card')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('castration_and_spays', function (Blueprint $table) {
            $table->string('vaccination_card')->nullable(false)->change();
        });
    }
};
