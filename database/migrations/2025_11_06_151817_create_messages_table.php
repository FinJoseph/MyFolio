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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email');
            $table->string('sujet')->nullable();
            $table->text('message');
            $table->string('statut')->default('nouveau'); // nouveau, lu, repondu, archive, spam
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->text('reponse')->nullable(); // Réponse de l'admin
            $table->timestamp('repondu_le')->nullable();
            $table->foreignId('repondu_par')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
