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

                $table->increments('id');
                $table->string('object_id', 30);
				$table->string('name');
				$table->integer('package_id')->unsigned();

                $table->timestamps();
                $table->softDeletes();
				
				$table->foreign('package_id', 'fk01_admin_resource')
					->references('id')
					->on('admin_package')
					->onDelete('restrict')
					->onUpdate('cascade');

                $table->index('object_id', 'ix01_admin_resource');
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