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
        Schema::create('unit_utility_services', function (Blueprint $table) {
            $table->id();
            $table->enum('type',  ['electricity', 'water', 'gas'])->unique();
            $table->varchar('owner_name', 100)->unique();
            $table->text('counter_number')->nullable();
            $table->text('electronic_payment_number')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            //FK
            $table->foreignId('unit_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_utility_services');
    }
};
