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
        Schema::create('subordinate_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subordinate_id')->constrained()->onDelete('cascade');
            $table->foreignId('training_id')->constrained()->onDelete('cascade');
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subordinate_trainings');
    }
};
