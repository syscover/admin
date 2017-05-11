<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTableCronJob extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('cron_job'))
		{
			Schema::create('cron_job', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->increments('id')->unsigned();
				$table->string('name');
				$table->integer('package_id')->unsigned();
				$table->string('cron_expression');
				$table->string('key');
				$table->integer('last_run')->unsigned();
				$table->integer('next_run')->unsigned();
				$table->boolean('active');

				$table->foreign('package_id', 'fk01_cron_job')
					->references('id')
					->on('package')
					->onDelete('cascade')
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
		Schema::dropIfExists('cron_job');
	}
}