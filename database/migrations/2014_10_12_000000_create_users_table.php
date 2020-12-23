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
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('name',100);
            $table->string('phn',20);
            $table->string('email',100);
            $table->text('address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('e_money')->nullable();
            $table->string('verified')->nullable();
            $table->string('verification_token')->nullable();
            $table->string('type')->default('user');
            $table->boolean('status')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
