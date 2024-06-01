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
        Schema::create('ligne_ventes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->foreignId('vente_id')->nullable(false)->constrained()->onDelete('cascade');      
            $table->unsignedInteger('quantite')->nullable(false);            
            $table->unsignedDouble('montant')->nullable(false);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_ventes');
    }
};
