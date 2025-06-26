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
        Schema::table('banners', function (Blueprint $table) {
            // Add user_id column with foreign key constraint
            $table->foreignId('user_id')
                  ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            // Drop foreign key first, then column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
