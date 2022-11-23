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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar', 50)->nullable();
            //nullable - this column can be empty ('null')
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('introduction', 100)->nullable();
            $table->integer('role_id')->default(2)->comment('admin: 1 | user: 2');
            //default gives the column a default value
            // comment is just a note on the column
            // $table->rememberToken();
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
