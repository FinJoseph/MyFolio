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
        Schema::create('competences', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('categorie'); // frontend, backend, design, outils, langage
            $table->integer('niveau')->default(50); // 0-100
            $table->string('icone')->nullable(); // Nom de l'icône ou URL
            $table->string('couleur')->nullable(); // Couleur hexadécimale
            $table->integer('ordre')->default(0);
            $table->boolean('est_visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competences');
    }
};
