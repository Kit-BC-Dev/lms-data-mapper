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
        Schema::create('client_charge_taxes', function (Blueprint $table) {
            $table->id('ClientChargeTaxID');
            $table->timestamp('DateCreated')->nullable();
            $table->timestamp('ModifiedDate')->nullable();
            $table->integer('ClientChargeID');
            $table->float('CashTaxValue');
            $table->float('TradeTaxValue');
            $table->float('CashTaxReversed');
            $table->float('CashTaxBalance');
            $table->float('TaxRate');
            $table->string('CreatedBy');
            $table->string('ModifiedBy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_charge_taxes');
    }
};
