<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTablePermission extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('permission'))
		{
			Schema::create('permission', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->integer('profile_id')->unsigned();
				$table->string('resource_id', 30);
				$table->string('action_id', 25);
				
				$table->foreign('profile_id', 'fk01_permission')
					->references('id')
					->on('profile')
					->onDelete('cascade')
					->onUpdate('cascade');
				$table->foreign('resource_id', 'fk02_permission')
					->references('id')
					->on('resource')
					->onDelete('cascade')
					->onUpdate('cascade');
				$table->foreign('action_id', 'fk03_permission')
					->references('id')
					->on('action')
					->onDelete('cascade')
					->onUpdate('cascade');
				
				$table->primary(['profile_id', 'resource_id', 'action_id'], 'pk01_permission');
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
		Schema::dropIfExists('permission');
	}
}