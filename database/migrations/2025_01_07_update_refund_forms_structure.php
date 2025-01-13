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
        Schema::table('refund_forms', function (Blueprint $table) {
            // Önce yeni sütunları ekle
            $table->string('name')->after('id')->nullable();
            $table->string('file')->nullable()->after('name');
            $table->boolean('status')->default(1)->after('file');
            
            // Sonra eski sütunu sil
            $table->dropColumn('pagecontent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('refund_forms', function (Blueprint $table) {
            // Önce yeni sütunları sil
            $table->dropColumn(['name', 'file', 'status']);
            
            // Sonra eski sütunu geri ekle
            $table->longText('pagecontent')->nullable()->after('id');
        });
    }
}; 