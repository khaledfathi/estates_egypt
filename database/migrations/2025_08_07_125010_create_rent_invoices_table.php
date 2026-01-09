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
        Schema::create('rent_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_value');
            $table->unsignedTinyInteger('for_month');
            $table->unsignedSmallInteger('for_year');
            $table->timestamps();
            //FK
            $table->foreignId('contract_id')->references('id')->on('unit_contracts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('transaction_id')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');
            //constrains
            $table->unique(['contract_id', 'for_month', 'for_year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_invoices');
    }
};
