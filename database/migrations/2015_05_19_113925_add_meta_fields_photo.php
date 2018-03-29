<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaFieldsPhoto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('photos', function(Blueprint $table)
        {
            $table->string('meta_name', 255); //70
            $table->string('meta_keywords', 255);
            $table->string('meta_description', 255); //150
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
            $table->dropColumn('meta_name');
            $table->dropColumn('meta_keywords');
            $table->dropColumn('meta_description');
        });
	}

}
