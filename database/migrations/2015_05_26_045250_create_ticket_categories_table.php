<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticket_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('category');

			$table->integer('ticket_id')->unsigned();
			$table->foreign('ticket_id')->references('id')->on('tickets');

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
		Schema::drop('ticket_categories');
	}

}
