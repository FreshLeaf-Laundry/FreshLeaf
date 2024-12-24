<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('code')->unique(); // Kode voucher (unik)
            $table->decimal('discount', 5, 2); // Diskon dalam bentuk persen
            $table->timestamp('expiry_date'); // Tanggal kadaluarsa
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers'); // Menghapus tabel voucher jika migration di-rollback
    }
}
