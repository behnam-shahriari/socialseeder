<?php

use App\Services\Core\EnumHelper;
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
            $table->id();
            $table->string('email')->unique();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('password');
            $table->string('phone')->nullable();
            $table->enum('permission', EnumHelper::actorPermissions());
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
