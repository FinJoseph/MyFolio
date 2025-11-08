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
        Schema::create('information_personnelles', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet')->nullable();
            $table->string('prenom');
            $table->string('nom');
            $table->string('titre_poste'); // Ex: Développeur Full-Stack & Designer
            $table->text('bio_courte'); // Bio courte pour hero section
            $table->longText('bio_complete')->nullable(); // Bio complète pour page à propos
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
            $table->string('code_postal')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('photo_profil')->nullable();
            $table->string('cv_pdf')->nullable(); // Lien vers le CV en PDF

            // Réseaux sociaux
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('dribbble')->nullable();
            $table->string('behance')->nullable();
            $table->string('youtube')->nullable();

            // Disponibilité
            $table->boolean('disponible_freelance')->default(true);
            $table->string('statut_disponibilite')->default('disponible'); // disponible, occupe, bientot_disponible
            $table->text('message_disponibilite')->nullable();

            // SEO
            $table->string('meta_titre')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('meta_mots_cles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_personnelles');
    }
};
