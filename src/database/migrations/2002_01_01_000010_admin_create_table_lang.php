<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCreateTableLang extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('lang'))
		{
			Schema::create('lang', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->string('id', 2);
				$table->string('name');
				$table->string('ico')->nullable();
				$table->smallInteger('sort')->unsigned();
				$table->boolean('base');
				$table->boolean('active');

				$table->primary('id', 'pk01_lang');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('lang');
	}
}