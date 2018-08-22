<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTableAction extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('admin_action'))
		{
			Schema::create('admin_action', function (Blueprint $table) {
				$table->engine = 'InnoDB';

                $table->increments('ix');
				$table->string('id', 25);
				$table->string('name');

                $table->timestamps();
                $table->softDeletes();

                $table->unique('id', 'ui01_admin_action');
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
		Schema::dropIfExists('admin_action');
	}
}