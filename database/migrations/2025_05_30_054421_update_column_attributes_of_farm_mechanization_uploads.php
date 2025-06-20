<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('farm_mechanization_uploads', function (Blueprint $table) {
            // Make uploaded_file nullable
            $table->string('uploaded_file')->nullable()->change();

            // Make or_date nullable and indexed (if not already indexed)
            $table->date('or_date')->nullable()->change();
            $table->index('or_date');
        });
    }

    public function down(): void
    {
        Schema::table('farm_mechanization_uploads', function (Blueprint $table) {
            // Revert uploaded_file to not nullable
            $table->string('uploaded_file')->nullable(false)->change();

            // Remove index from or_date (if exists)
            $table->dropIndex(['or_date']);
            // Optionally revert or_date to not nullable (if needed)
            $table->date('or_date')->nullable(false)->change();
        });
    }
};
