<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role'); // Menghapus kolom role
            $table->boolean('is_admin')->default(false); // Menambahkan kolom is_admin
        });
    }

    public function down()
    {
    }
};
