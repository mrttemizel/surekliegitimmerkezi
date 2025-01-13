<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('on_basvuru_forms', function (Blueprint $table) {
            $table->string('electronic', 255)->nullable()->after('kvkk');
            $table->string('explicit', 255)->nullable()->after('electronic');
        });
    }

    public function down()
    {
        Schema::table('on_basvuru_forms', function (Blueprint $table) {
            $table->dropColumn(['electronic', 'explicit']);
        });
    }
}; 