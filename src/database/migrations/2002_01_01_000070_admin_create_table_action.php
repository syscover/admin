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
		if(! Schema::hasTable('action'))
		{
			Schema::create('action', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->string('id', 25);
				$table->string('name');

                $table->timestamps();
                $table->softDeletes();

				$table->primary('id', 'pk01_action');
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
		Schema::dropIfExists('action');
	}
}