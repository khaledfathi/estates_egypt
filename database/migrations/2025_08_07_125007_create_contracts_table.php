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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['old_law','new_law']);
            $table->unsignedInteger('rent_value');
            $table->unsignedInteger('insurance_value')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedTinyInteger('water_invoice_precentage');
            $table->timestamps();
            //FK
            $table->foreignId('unit_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('renter_id')->references('id')->on('renters')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
