<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTableTerritorialArea2 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('territorial_area_2'))
		{
			Schema::create('territorial_area_2', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->string('id', 10);
				$table->string('country_id', 2);
				$table->string('territorial_area_1_id', 6);
				$table->string('name');
				
				$table->foreign('country_id', 'fk01_territorial_area_2')
					->references('id')
					->on('country')
					->onDelete('restrict')
					->onUpdate('cascade');
				$table->foreign('territorial_area_1_id', 'fk02_territorial_area_2')
					->references('id')
					->on('territorial_area_1')
					->onDelete('restrict')
					->onUpdate('cascade');
				
				$table->primary('id', 'pk01_territorial_area_2');
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
		Schema::dropIfExists('territorial_area_2');
	}
}