<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTableResource extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('resource'))
		{
			Schema::create('resource', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->string('id', 30);
				$table->string('name');
				$table->integer('package_id')->unsigned();
				
				$table->foreign('package_id', 'fk01_resource')
					->references('id')
					->on('package')
					->onDelete('restrict')
					->onUpdate('cascade');
				
				$table->primary('id', 'pk01_resource');
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
		if (Schema::hasTable('resource'))
		{
			Schema::drop('resource');
		}
	}
}