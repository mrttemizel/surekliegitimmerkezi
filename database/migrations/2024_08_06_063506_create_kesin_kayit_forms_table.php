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
        Schema::create('kesin_kayit_forms', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('kurs_id');
            $table->string('kurs_adi');
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('phone');
            $table->string('tc');
            $table->string('kimlik')->nullable();
            $table->string('diploma')->nullable();
            $table->string('kurumkarti')->nullable();
            $table->string('kvkk');
            $table->string('address');
            $table->integer('status')->default(0);
            $table->integer('mezun_durumu')->default(0);

            $table->unsignedBigInteger('sinif_id')->nullable();
            $table->foreign('sinif_id')->references('id')->on('siniflars')->onDelete('cascade');
            $table->string('barcode')->nullable();
            $table->string('sertificate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesin_kayit_forms');
    }
};
