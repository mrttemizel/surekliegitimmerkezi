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
        Schema::create('on_basvuru_forms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kurs_id');
            $table->string('kurs_adi');
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('phone');
            $table->string('kvkk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('on_basvuru_forms');
    }
};
