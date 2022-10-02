<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	public function up()
	{
		Schema::create('students', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('teacher_id')->unsigned()->nullable();
			$table->string('name')->nullable();
			$table->integer('age')->nullable();
			$table->enum('gender', array('0', '1'))->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('students');
	}
}