<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('midtrans_payments', function (Blueprint $table) {
            $table->string('transaction_id')->nullable();
            $table->decimal('gross_amount', 10, 2)->nullable();
            $table->string('payment_type')->nullable();
            $table->timestamp('settlement_time')->nullable();
            $table->string('currency')->nullable();
        });
    }

    public function down()
    {
        Schema::table('midtrans_payments', function (Blueprint $table) {
            $table->dropColumn(['transaction_id', 'gross_amount', 'payment_type', 'settlement_time', 'currency']);
        });
    }
};