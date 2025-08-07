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
        Schema::create('estate_utility_service_invoices', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['electriciy, water']);
            $table->unsignedTinyInteger('for_month');
            $table->unsignedSmallInteger('for_year');
            $table->timestamps();
            //FK
            $table->foreignId('estate_id')->references('id')->on('estates')->onUpdate('cascade')->onDelete('cascade');
            //constrains
            $table->unique(['estate_id', 'type', 'for_month', 'for_year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estate_utility_service_invoices');
    }
};
