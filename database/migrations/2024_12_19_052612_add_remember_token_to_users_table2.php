<?php
   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   class AddRememberTokenToUsersTable2 extends Migration
   {
       public function up()
       {
           Schema::table('users', function (Blueprint $table) {
               $table->rememberToken(); // Menambahkan kolom remember_token
           });
       }

       public function down()
       {
           Schema::table('users', function (Blueprint $table) {
               $table->dropRememberToken(); // Menghapus kolom remember_token jika migration dibatalkan
           });
       }
   };