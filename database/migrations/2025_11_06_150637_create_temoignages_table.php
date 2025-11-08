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
        Schema::create('temoignages', function (Blueprint $table) {
            $table->id();
            $table->string('nom_client');
            $table->string('poste_client')->nullable();
            $table->string('entreprise_client')->nullable();
            $table->string('avatar_client')->nullable();
            $table->text('contenu');
            $table->integer('note')->default(5); // 1-5 étoiles
            $table->foreignId('projet_id')->nullable()->constrained('projets')->nullOnDelete();
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
        Schema::dropIfExists('temoignages');
    }
};
