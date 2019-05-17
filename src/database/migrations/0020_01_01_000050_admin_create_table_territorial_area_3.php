<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTableTerritorialArea3 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('admin_territorial_area_3'))
		{
			Schema::create('admin_territorial_area_3', function (Blueprint $table) {
				$table->engine = 'InnoDB';

                $table->increments('ix');
				$table->string('id', 10);
				$table->string('country_id', 2);
				$table->string('territorial_area_1_id', 6);
				$table->string('territorial_area_2_id', 10);
				$table->string('name');
                $table->string('slug')->nullable();

                $table->timestamps();
                $table->softDeletes();
				
				$table->foreign('country_id', 'fk01_admin_territorial_area_3')
					->references('id')
					->on('admin_country')
					->onDelete('restrict')
					->onUpdate('cascade');
				$table->foreign('territorial_area_1_id', 'fk02_admin_territorial_area_3')
					->references('id')
					->on('admin_territorial_area_1')
					->onDelete('restrict')
					->onUpdate('cascade');
				$table->foreign('territorial_area_2_id', 'fk03_admin_territorial_area_3')
					->references('id')
					->on('admin_territorial_area_2')
					->onDelete('restrict')
					->onUpdate('cascade');

                $table->unique('id', 'admin_territorial_area_3_id_uq');
                $table->index('slug', 'ix02_admin_territorial_area_3');
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
		Schema::dropIfExists('admin_territorial_area_3');
	}
}
