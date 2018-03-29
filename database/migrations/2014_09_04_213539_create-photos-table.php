<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('artist_id')->unsigned();
			$table->string('category_id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('title');
			$table->string('slug')->unique();
			$table->mediumText('description');
			$table->enum('orientation', array('portrait', 'landscape'));
			$table->decimal('price', 5, 2);
			$table->string('large_file');
			$table->string('preview_file');
			$table->string('thumbnail_file');
                        $table->enum('order_count');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('photos');
	}

}
