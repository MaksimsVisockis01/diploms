<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // colums in database
            $table->string('name'); //user's name
            $table->string('email')->unique();  //email

            $table->string('avatar')->nullable(); // avatar
            $table->boolean('active')->default(true); //for admins control

            $table->string('uid')->unique(); // username
            
            $table->string('password');
            // $table->rememberToken();


        });
    }

    
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
