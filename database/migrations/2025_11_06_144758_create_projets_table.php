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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description');
            $table->longText('contenu')->nullable();
            $table->string('image')->nullable();
            $table->json('galerie')->nullable(); // Images supplémentaires
            $table->json('technologies')->nullable();
            $table->string('url_projet')->nullable();
            $table->string('url_github')->nullable();
            $table->string('categorie')->nullable();
            $table->integer('ordre')->default(0);
            $table->boolean('est_mis_en_avant')->default(false);
            $table->date('date_projet')->nullable();
            $table->timestamp('publie_le')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
