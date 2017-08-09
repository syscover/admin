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
		if(! Schema::hasTable('admin_territorial_area_1'))
		{
			Schema::create('admin_territorial_area_1', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->string('id', 6);
				$table->string('country_id', 2);
				$table->string('name');

                $table->timestamps();
                $table->softDeletes();
				
				$table->foreign('country_id', 'fk01_admin_territorial_area_1')
					->references('id')
					->on('admin_country')
					->onDelete('restrict')
					->onUpdate('cascade');
				
				$table->primary('id', 'pk01_admin_territorial_area_1');
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
		Schema::dropIfExists('admin_territorial_area_1');
	}
}