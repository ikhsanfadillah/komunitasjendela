<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email',250)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('isActive')->default(1);

            $table->rememberToken();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();


        });

        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('user_details', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('city_id')->nullable();
            $table->string('address')->nullable();
            $table->string('nik')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('activities')->nullable();
            $table->enum('gender',['M','F']);
            $table->date('dob')->nullable();
            $table->date('join_dt')->nullable();

            $table->primary('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('set null');
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
