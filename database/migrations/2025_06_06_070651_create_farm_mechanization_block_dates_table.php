<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('farm_mechanization_block_dates', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->date('block_date')->index();
            $table->longText('reason')->nullable();
            $table->foreignIdFor(User::class)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_mechanization_block_dates');
    }
};
