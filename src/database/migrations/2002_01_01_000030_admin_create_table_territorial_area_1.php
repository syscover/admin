<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTableTerritorialArea1 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('territorial_area_1'))
		{
			Schema::create('territorial_area_1', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->string('id', 6);
				$table->string('country_id', 2);
				$table->string('name');
				
				$table->foreign('country_id', 'fk01_territorial_area_1')
					->references('id')
					->on('country')
					->onDelete('restrict')
					->onUpdate('cascade');
				
				$table->primary('id', 'pk01_territorial_area_1');
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
		if (Schema::hasTable('territorial_area_1'))
		{
			Schema::drop('territorial_area_1');
		}
	}
}