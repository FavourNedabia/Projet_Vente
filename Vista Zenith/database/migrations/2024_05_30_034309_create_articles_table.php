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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable(false)->unique();
            $table->string('libelle')->nullable(false);
            $table->unsignedInteger('stock');
            $table->unsignedDouble('prix_achat');
            $table->unsignedDouble('prix_vente');
            $table->foreignId('categorie_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
