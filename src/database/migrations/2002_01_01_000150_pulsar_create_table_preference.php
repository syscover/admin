<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PulsarCreateTablePreference extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('preference'))
		{
			Schema::create('preference', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->string('id', 50);
				$table->integer('package_id')->unsigned();
				$table->text('value')->nullable();
				$table->timestamps();
				
				$table->foreign('package_id', 'fk01_preference')
					->references('id')
					->on('package')
					->onDelete('restrict')
					->onUpdate('cascade');
				
				$table->primary('id', 'pk01_preference');
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
		if (Schema::hasTable('preference'))
		{
			Schema::drop('preference');
		}
	}
}