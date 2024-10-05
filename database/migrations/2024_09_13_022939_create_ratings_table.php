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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Student who rated the class
            $table->foreignId('material_id')->constrained('material')->onDelete('cascade'); // Student who rated the class
            $table->unsignedTinyInteger('rating')->comment('Rating from 1 to 5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
