<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestMembershipChanges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('photos', function(Blueprint $table)
		{
			$table->text('tags');
		});

		Schema::create('countries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code', 5);
			$table->string('name', 150);
			$table->integer('mapPlaceId')->unsigned();
		});

		Schema::create('states', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('country_id')->unsigned();
			$table->string('name', 100);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('photos', function(Blueprint $table)
		{
			$table->dropColumn('tags');
		});

		Schema::drop('countries');
		Schema::drop('states');

	}
}

