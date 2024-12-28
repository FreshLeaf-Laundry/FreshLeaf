<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('discount', 10, 2);
            $table->date('expiry_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
};
