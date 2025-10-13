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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('number');
            $table->unsignedTinyInteger('floor_number');
            $table->enum ('type', ['commercial','residential']);
            $table->boolean('is_empty')->default(true);
            $table->timestamps();
            //FK
            $table->foreignId('estate_id')->references('id')->on('estates')->onUpdate('cascade')->onDelete('cascade');
            //constrain
            $table->unique(['estate_id', 'type', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
