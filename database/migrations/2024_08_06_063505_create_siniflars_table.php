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
        Schema::create('siniflars', function (Blueprint $table) {
            $table->id();
            $table->string('sinif_adi');
            $table->longText('slug');
            $table->integer('sertifika_dili')->nullable();
            $table->string('sertifika')->nullable();
            $table->string('egitici_adi')->nullable();
            $table->date('baslangic_tarihi')->nullable();
            $table->date('bitis_tarihi')->nullable();
            $table->integer('sertifika_tipi')->nullable();
            $table->integer('status')->default(1);
            $table->integer('sinif_durumu')->default(1);

            $table->unsignedBigInteger('egitim_id')->nullable();
            $table->foreign('egitim_id')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siniflars');
    }
};
