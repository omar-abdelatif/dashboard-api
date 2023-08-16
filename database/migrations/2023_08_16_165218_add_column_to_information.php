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
        Schema::table('information', function (Blueprint $table) {
            $table->string('facebook_link')->after('img');
            $table->string('github_link')->after('facebook_link');
            $table->string('whatsapp_link')->after('github_link');
            $table->string('linkedin_link')->after('whatsapp_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('information', function (Blueprint $table) {
            $table->dropColumn('facebook_link');
            $table->dropColumn('github_link');
            $table->dropColumn('whasapp_link');
            $table->dropColumn('linkedin_link');
        });
    }
};
