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
        Schema::table('testmonials', function (Blueprint $table) {
            $table->string('client_name')->after('id');
            $table->string('title')->after('client_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testmonials', function (Blueprint $table) {
            $table->dropColumn('client_name');
            $table->dropColumn('title');
        });
    }
};
