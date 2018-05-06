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
		if(! Schema::hasTable('admin_cron_job'))
		{
			Schema::create('admin_cron_job', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->increments('id')->unsigned();
				$table->string('name');
				$table->integer('package_id')->unsigned();
				$table->string('cron_expression');
				$table->string('command');
				$table->timestamp('last_run')->default(DB::raw('CURRENT_TIMESTAMP'));
				$table->timestamp('next_run')->default(DB::raw('CURRENT_TIMESTAMP'));
				$table->boolean('active')->default(false);

				$table->timestamps();
                $table->softDeletes();

				$table->foreign('package_id', 'fk01_cron_job')
					->references('id')
					->on('admin_package')
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
		Schema::dropIfExists('admin_cron_job');
	}
}