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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('egitim_adi')->nullable();
            $table->string('egitim_adi_ing')->nullable();
            $table->string('egitim_kordinatorleri')->nullable();
            $table->date('egitim_baslangic_tarihi')->nullable();
            $table->date('egitim_bitis_tarihi')->nullable();
            $table->string('egitim_saati')->nullable();
            $table->string('egitim_platformu')->nullable();
            $table->string('egitim_yeri')->nullable();
            $table->string('egitici_adi')->nullable();
            $table->string('egitim_ücreti')->nullable();
            $table->string('egitim_katilim_sarti')->nullable();
            $table->string('egitim_kontejyani')->nullable();
            $table->string('image')->nullable();


            $table->longText('detay')->nullable();


                $table->string('on_basvuru')->default('off')->nullable();
                $table->string('kesin_kayit')->default('off')->nullable();
                $table->string('kimlik')->default('off')->nullable();
                $table->string('diploma')->default('off')->nullable();
                $table->string('kurumkarti')->default('off')->nullable();



            $table->string('slug')->nullable();
            $table->integer('status')->default(1);


            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
