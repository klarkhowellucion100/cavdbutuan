<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('farm_mechanization_cash_collections', function (Blueprint $table) {
            $table->bigInteger('endorsed_to_id')->nullable()->index();
            $table->date('date_endorsed')->nullable()->index();
            $table->longText('remarks')->nullable();
            $table->bigInteger('responsible_person_id')->nullable()->index();
            $table->bigInteger('approved_by_id')->nullable()->index();
            $table->date('date_approved')->nullable()->index();
            $table->string('control_number')->nullable()->index();
            $table->double('fees_charge')->nullable()->index();
            $table->date('final_schedule')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::table('farm_mechanization_cash_collections', function (Blueprint $table) {
            $table->dropIndex(['endorsed_to_id']);
            $table->dropIndex(['date_endorsed']);
            $table->dropIndex(['responsible_person_id']);
            $table->dropIndex(['approved_by_id']);
            $table->dropIndex(['date_approved']);
            $table->dropIndex(['control_number']);
            $table->dropIndex(['fees_charge']);
            $table->dropIndex(['final_schedule']);
            $table->dropColumn([
                'endorsed_to_id',
                'date_endorsed',
                'remarks',
                'responsible_person_id',
                'approved_by_id',
                'date_approved',
                'control_number',
                'fees_charge',
                'final_schedule',
            ]);
        });
    }
};
