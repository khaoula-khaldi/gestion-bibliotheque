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
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('isbn')->unique();      
            $table->integer('annee');   
            $table->string('type', 50);              
            $table->text('description'); 
            $table->decimal('prix_achat', 8, 2)->default(0);
            $table->decimal('prix_emprunt', 8, 2)->default(0);         
            $table->tinyInteger('disponible')->default(1);
            $table->integer('quantite')->default(0); 
            $table->string('image')->nullable();
            $table->foreignId('auteur_id')->constrained('auteurs')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livres');
    }
};
