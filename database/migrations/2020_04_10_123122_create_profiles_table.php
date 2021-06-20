<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('phone_number')->nullable();
            $table->string('profession')->nullable();
            $table->string('description')->nullable();
            $table->string('date_birth')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('form_id')->nullable();
            $table->string('profile_pic')->nullable();
            $table->timestamps();

            $table->index('form_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
