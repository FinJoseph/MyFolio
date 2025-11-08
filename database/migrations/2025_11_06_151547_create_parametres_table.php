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
        Schema::create('parametres', function (Blueprint $table) {
            $table->id();
            $table->string('cle')->unique(); // Clé unique du paramètre
            $table->text('valeur')->nullable(); // Valeur du paramètre
            $table->string('type')->default('text'); // text, json, boolean, number
            $table->string('groupe')->default('general'); // general, social, seo, contact, appearance, stats
            $table->text('description')->nullable(); // Description du paramètre
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametres');
    }
};
