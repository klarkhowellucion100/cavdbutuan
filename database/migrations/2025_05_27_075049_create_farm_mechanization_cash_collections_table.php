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
        Schema::create('farm_mechanization_cash_collections', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->bigInteger('farm_mechanization_id')->unique();
            $table->string('transaction_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_mechanization_cash_collections');
    }
};
