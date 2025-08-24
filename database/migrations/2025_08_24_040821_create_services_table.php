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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('translator_id')->constrained('translators')->onDelete('cascade');
            $table->foreignId('language1_id')->constrained('languages')->onDelete('cascade');
            $table->foreignId('language2_id')->constrained('languages')->onDelete('cascade');
            $table->double('price')->default(300);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
