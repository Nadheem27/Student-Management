<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('students', function(Blueprint $table) {
			$table->foreign('teacher_id')->references('id')->on('teachers')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('marks', function(Blueprint $table) {
			$table->foreign('student_id')->references('id')->on('students')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('marks', function(Blueprint $table) {
			$table->foreign('term_id')->references('id')->on('term')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('students', function(Blueprint $table) {
			$table->dropForeign('students_teacher_id_foreign');
		});
		Schema::table('marks', function(Blueprint $table) {
			$table->dropForeign('marks_student_id_foreign');
		});
		Schema::table('marks', function(Blueprint $table) {
			$table->dropForeign('marks_term_id_foreign');
		});
	}
}