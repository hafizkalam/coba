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

        Schema::create('rating_comments', function (Blueprint $table) {
            $table->id();
            $table->string('id_menu');
            $table->string('nama_pemesan')->nullable();
            $table->string('rating')->nullable();
            $table->string('ulasan')->nullable();
            $table->date('tgl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('rating_comments');
    }
};
