<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_user', function (Blueprint $table) {
            $table->primary(['user_id', 'employee_id']);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('employee_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_user');
    }
}
