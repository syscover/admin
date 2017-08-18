<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTableProfile extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('admin_profile'))
		{
			Schema::create('admin_profile', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->increments('id')->unsigned();
				$table->string('name');

                $table->timestamps();
                $table->softDeletes();
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
		Schema::dropIfExists('admin_profile');
	}
}