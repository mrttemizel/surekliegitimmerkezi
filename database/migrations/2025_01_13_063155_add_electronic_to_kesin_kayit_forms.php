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
        Schema::table('kesin_kayit_forms', function (Blueprint $table) {
            $table->string('explicit')->nullable()->after('kvkk');
            $table->string('electronic')->nullable()->after('kvkk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kesin_kayit_forms', function (Blueprint $table) {
            //
        });
    }
};
