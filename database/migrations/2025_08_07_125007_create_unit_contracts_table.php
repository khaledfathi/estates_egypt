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
        Schema::create('unit_contracts', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['old_law','new_law']);
            $table->unsignedInteger('rent_value');
            $table->tinyInteger('annual_rent_increasement')->default(0);
            $table->unsignedInteger('insurance_value')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('water_invoice_percentage')->default(1);
            $table->unsignedInteger('electricity_invoice_percentage')->default(1);
            $table->timestamps();
            //FK
            $table->foreignId('unit_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('renter_id')->nullable()->references('id')->on('renters')->onUpdate('cascade')->onDelete('set null');
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
