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
        Schema::table('traders', function (Blueprint $table) {
            $table->foreignId('governate_id')->nullable()->after('user_id');
            $table->foreign('governate_id')->references('id')->on('governates')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('traders', function (Blueprint $table) {
            $table->dropForeign(['governate_id']);
            $table->dropColumn('governate_id');
        });
    }
};
