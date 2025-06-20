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
        Schema::create('castration_and_spays', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique();

            $table->string('full_name')->index();
            $table->string('sex')->index();
            $table->date('birthdate')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('region_id')->index();
            $table->bigInteger('province_id')->index();
            $table->bigInteger('municipality_id')->index();
            $table->bigInteger('barangay_id')->index();
            $table->string('specific_location')->nullable();

            $table->string('service_type')->index();

            $table->string('animal_type')->index();
            $table->string('animal_specie')->nullable()->index();
            $table->string('animal_name')->nullable();
            $table->string('animal_sex')->index();
            $table->bigInteger('animal_age_year')->index()->nullable();
            $table->bigInteger('animal_age_month')->index()->nullable();
            $table->date('animal_birthdate')->index()->nullable();
            $table->string('animal_color')->nullable()->index();

            $table->date('visitation_schedule')->index();
            $table->time('time_from')->index();
            $table->time('time_to')->index();
            $table->bigInteger('request_status')->index();

            $table->string('vaccination_status')->index();
            $table->string('vaccination_date')->index();
            $table->string('vaccination_card');

            $table->bigInteger('assigned_veterinarian_id')->index()->nullable();
            $table->longText('remarks')->index()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('castration_and_spays');
    }
};
