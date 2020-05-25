<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->date('date');
            $table->string('level');

            // STUDENT
            /*
             * type
             * 1 = inscripción
             * 2 = reinscripción
             */
            $table->string('name');
            $table->string('last_name');
            $table->string('mat_last_name')->nullable();
            $table->string('curp', 18);
            $table->string('grade');
            $table->string('sanguine', 10);
            $table->string('place_birth');
            $table->date('birthday');
            $table->integer('age');
            $table->string('street');
            $table->string('number');
            $table->string('colony');
            $table->string('town');
            $table->string('zip_code');
            $table->string('origin_school')->nullable();

            //PARENTS

            //FATHER
            $table->string('f_name');
            $table->string('f_last_name');
            $table->string('f_mat_last_name')->nullable();
            $table->string('f_company')->nullable();
            $table->string('f_position')->nullable();
            $table->string('f_office_phone')->nullable();
            $table->string('f_home_phone')->nullable();
            $table->string('f_cellphone')->nullable();
            $table->string('f_email')->nullable();

            //MOTHER
            $table->string('m_name');
            $table->string('m_last_name');
            $table->string('m_mat_last_name')->nullable();
            $table->string('m_company')->nullable();
            $table->string('m_position')->nullable();
            $table->string('m_office_phone')->nullable();
            $table->string('m_home_phone')->nullable();
            $table->string('m_cellphone')->nullable();
            $table->string('m_email')->nullable();

            //FAMILY
            $table->string('o_name');
            $table->string('o_last_name');
            $table->string('o_mat_last_name')->nullable();
            $table->string('relationship');
            $table->string('o_office_phone')->nullable();
            $table->string('o_home_phone')->nullable();
            $table->string('o_cellphone')->nullable();
            $table->string('o_email')->nullable();

            $table->string('observations', 255);
            /*
             * authorization
             * 1 = si
             * 2 = no
             */
            $table->integer('authorization');
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
        Schema::dropIfExists('request');
    }
}
