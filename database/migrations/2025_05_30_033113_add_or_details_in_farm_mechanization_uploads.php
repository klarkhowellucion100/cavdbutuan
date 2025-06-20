<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('farm_mechanization_uploads', function (Blueprint $table) {
            $table->string('or_number')->nullable()->after('transaction_number');
            $table->date('or_date')->nullable()->after('or_number');
        });
    }

    public function down(): void
    {
        Schema::table('farm_mechanization_uploads', function (Blueprint $table) {
            $table->dropColumn(['or_number', 'or_date']);
        });
    }
};
