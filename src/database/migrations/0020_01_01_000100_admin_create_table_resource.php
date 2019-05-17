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
		if(! Schema::hasTable('admin_resource'))
		{
			Schema::create('admin_resource', function (Blueprint $table) {
				$table->engine = 'InnoDB';

                $table->increments('ix');
                $table->string('id', 30);
				$table->string('name');
				$table->integer('package_id')->unsigned();

                $table->timestamps();
                $table->softDeletes();

                $table->unique('id', 'admin_resource_id_uq');
				$table->foreign('package_id', 'fk01_admin_resource')
					->references('id')
					->on('admin_package')
					->onDelete('restrict')
					->onUpdate('cascade');

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
		Schema::dropIfExists('admin_resource');
	}
}
