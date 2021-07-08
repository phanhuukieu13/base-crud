<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_user', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('status');
            $table->integer('is_deleted');
            $table->timestamp('deleted_at');
            $table->timestamps();
            // $table->rememberToken();
            // $table->timestamp('email_verified_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_user');
    }
}
