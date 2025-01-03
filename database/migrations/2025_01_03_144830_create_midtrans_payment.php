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
        Schema::create('midtrans_payments', function (Blueprint $table) {
            $table->id();
            $table->string('cart_id');
            $table->string('payment_status');
            $table->decimal('payment_amount', 10, 2);
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midtrans_payments');
    }
};
