<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('farm_mechanizations', function (Blueprint $table) {
            $table->string('transaction_number')->unique();
            $table->string('full_name')->index();
            $table->string('machinery')->index();
            $table->string('sex')->index();
            $table->date('birthdate')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('region_id')->index();
            $table->bigInteger('province_id')->index();
            $table->bigInteger('municipality_id')->index();
            $table->bigInteger('barangay_id')->index();
            $table->string('specific_location')->nullable();
            $table->string('category')->index();
            $table->double('area_size');
            $table->longText('details')->nullable();
            $table->date('proposed_schedule')->index()->nullable();
            $table->bigInteger('request_status')->index()->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('farm_mechanizations', function (Blueprint $table) {
            $table->dropUnique(['transaction_number']);
            $table->dropColumn([
                'transaction_number',
                'full_name',
                'machinery',
                'sex',
                'birthdate',
                'contact_number',
                'email',
                'region_id',
                'province_id',
                'municipality_id',
                'barangay_id',
                'specific_location',
                'category',
                'area_size',
                'details',
                'proposed_schedule',
                'request_status',
            ]);
        });
    }
};
