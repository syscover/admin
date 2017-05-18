<?php

use Illuminate\Database\Migrations\Migration;

class PulsarCreateTableAttachmentMime extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('attachment_mime'))
		{
			Schema::create('attachment_mime', function ($table) {
				$table->engine = 'InnoDB';

				$table->increments('id')->unsigned();
				$table->string('resource_id', 30);
				$table->string('mime');

				$table->foreign('resource_id', 'fk01_attachment_mime')
					->references('id')
					->on('resource')
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
        Schema::dropIfExists('attachment_mime');
	}
}