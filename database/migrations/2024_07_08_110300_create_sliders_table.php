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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('image_mobil')->nullable();
            $table->string('slider_ust_baslik')->nullable();
            $table->text('slider_aciklama')->nullable();
            $table->text('slider_button_link')->nullable();
            $table->text('slider_video_link')->nullable();
            $table->integer('status')->default(1);
            $table->integer('order')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
