<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('actors');
        Schema::create('actors', function (Blueprint $table) {
            $table->uuid('username');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('password');
            $table->string('phone');
            $table->boolean('type')->default(1); // 0:User, 1:Client
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
        Schema::dropIfExists('actors');
    }
}
