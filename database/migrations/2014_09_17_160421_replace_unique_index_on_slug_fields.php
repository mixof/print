<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReplaceUniqueIndexOnSlugFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('artists', function(Blueprint $table)
		{
			$table->dropUnique('artists_slug_unique');
			$table->index('slug');
		});

		Schema::table('categories', function(Blueprint $table)
		{
			$table->dropUnique('categories_slug_unique');
			$table->index('slug');
		});

		Schema::table('photos', function(Blueprint $table)
		{
			$table->dropUnique('photos_slug_unique');
			$table->index('slug');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('artists', function(Blueprint $table)
		{
			$table->dropIndex('artists_slug_index');
			$table->unique('slug');
		});

		Schema::table('categories', function(Blueprint $table)
		{
			$table->dropIndex('categories_slug_index');
			$table->unique('slug');
		});

		Schema::table('photos', function(Blueprint $table)
		{
			$table->dropIndex('photos_slug_index');
			$table->unique('slug');
		});
	}

}
