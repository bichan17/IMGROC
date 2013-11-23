<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProvocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('provocations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 100);
			$table->string('source');
			$table->string('img');
			$table->text('caption');
			$table->integer('mod_status');
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
		Schema::drop('provocations');
	}

}
