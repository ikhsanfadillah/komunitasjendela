<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_parents', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('relationship',['Ayah',['Ibu'],['Wali']]);
            $table->string('name');
            $table->string('address');
            $table->string('job');
            $table->string('education');
            $table->year('birth_year');
            $table->decimal('monthly_income', 20, 0);
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
        Schema::dropIfExists('parents');
    }
}
