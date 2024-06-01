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
        Schema::create('ligne_approvisionnements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->foreignId('approvisionnement_id')->nullable(false)->constrained()->onDelete('cascade');    
            $table->unsignedInteger('quantite')->nullable(false);            
            $table->unsignedDouble('montant')->nullable(true);              
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_approvisionnements');
    }
};
