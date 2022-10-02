<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTermTable extends Migration {

	public function up()
	{
		Schema::create('term', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('term');
	}
}