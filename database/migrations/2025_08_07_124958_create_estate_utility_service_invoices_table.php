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
            $table->unsignedTinyInteger('for_month');
            $table->unsignedSmallInteger('for_year');
            $table->integer('amount');
            $table->text('file')->nullable();
            $table->timestamps();
            //FK
            $table->foreignId('estate_utility_service_id')->references('id')->on('estate_utility_services')->onUpdate('cascade')->onDelete('cascade');
            //constrains
            $table->unique(['estate_utility_service_id', 'for_month', 'for_year']);
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
