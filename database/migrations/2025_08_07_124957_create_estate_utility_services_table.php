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
        Schema::create('estate_utility_services', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['electricity','water']);
            $table->string('owner_name', 100);
            $table->text('counter_number' )->nullable();
            $table->text('electronic_payment_number' )->nullable();
            $table->text('notes' )->nullable();
            $table->timestamps();
            //FK
            $table->foreignId('estate_id')->references('id')->on('estates')->onUpdate('cascade')->onDelete('cascade');
            //constrained
            $table->unique(['estate_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estate_utility_services');
    }
};
