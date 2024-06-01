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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->foreignId('personnel_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->unsignedDouble('total')->nullable(true);
            $table->enum('status', ['Paid', 'Credit', 'Paid partialy'])->nullable(false);
            $table->unsignedDouble('reste')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
