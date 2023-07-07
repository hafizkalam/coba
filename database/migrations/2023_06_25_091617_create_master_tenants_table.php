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
        Schema::create('master_tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name_tenant');
            $table->string('name_menu')->nullable();
            $table->string('harga_menu')->nullable();
            $table->string('foto_menu')->nullable();
            $table->string('desc_menu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_tenants');
    }
};
