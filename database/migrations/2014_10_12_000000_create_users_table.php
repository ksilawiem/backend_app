<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('address');
            $table->string('city');
            $table->date('birthDate');
            $table->string('gender');
            $table->string('role');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('email_verified')->default(0);
            $table->string('cv')->nullable();
            $table->string('photo')->nullable();
            $table->string('company')->nullable();
            $table->string('modePaiment')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->date('début')->nullable();
            $table->date('fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
