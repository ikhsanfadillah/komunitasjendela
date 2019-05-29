<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('subbranch_id')->nullable();
            $table->string('name');
            $table->string('nickname')->nullable()->unique();
            $table->string('address')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->enum('religion',['Islam','Kristen Protestan','Kristen Katolik','Hindu','Buddha','Konghucu']);
            $table->enum('gender',['M','F']);
            $table->string('grade')->nullable();
            $table->string('schoolname')->nullable();
            $table->boolean('isActive')->default(1);
            $table->unsignedTinyInteger('order')->nullable();
            $table->unsignedTinyInteger('number_of_siblings')->nullable();
            $table->date('join_dt')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('subbranch_id')
                ->references('id')
                ->on('subbranches')
                ->onUpdate('set null')
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
        Schema::dropIfExists('students');
    }
}
