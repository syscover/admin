<?php

use Illuminate\Database\Migrations\Migration;

class AdminCreateTableAttachmentMime extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('admin_attachment_mime'))
		{
			Schema::create('admin_attachment_mime', function ($table) {
				$table->engine = 'InnoDB';

				$table->increments('id');
				$table->string('resource_id', 30);
				$table->string('mime');

                $table->timestamps();
                $table->softDeletes();

				$table->foreign('resource_id', 'fk01_admin_attachment_mime')
					->references('object_id')
					->on('admin_resource')
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
        Schema::dropIfExists('admin_attachment_mime');
	}
}