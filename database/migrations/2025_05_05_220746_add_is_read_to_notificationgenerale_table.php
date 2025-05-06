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
        Schema::table('notificationgenerale', function (Blueprint $table) {
            //
            $table->boolean('is_read')->default(false);  // Par défaut, non lue
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notificationgenerale', function (Blueprint $table) {
            //
            $table->dropColumn('is_read');
        });
    }
};
