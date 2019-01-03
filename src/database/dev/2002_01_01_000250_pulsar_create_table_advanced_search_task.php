<?php

use Illuminate\Database\Migrations\Migration;

class PulsarCreateTableAdvancedSearchTask extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('advanced_search_task'))
		{
			Schema::create('advanced_search_task', function ($table) {
				$table->engine = 'InnoDB';

				$table->increments('id');
				$table->integer('date')->unsigned();
				$table->integer('user_id')->unsigned();
				$table->string('model');
				$table->text('parameters')->nullable();
				$table->string('extension_file');
				$table->string('filename');
				$table->boolean('created')->default(false);

				$table->foreign('user_id', 'fk01_advanced_search_task')
					->references('id')
					->on('user')
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
        Schema::dropIfExists('advanced_search_task');
	}
}