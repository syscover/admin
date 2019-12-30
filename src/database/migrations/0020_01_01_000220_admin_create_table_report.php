<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTableReport extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('admin_report'))
		{
			Schema::create('admin_report', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->increments('id');

                $table->string('subject');
                $table->json('emails');
                $table->json('profiles');

                $table->string('filename');
                $table->string('extension');

                $table->tinyInteger('frequency_id')->unsigned();

                $table->text('statement')->nullable();
                $table->text('sql')->nullable();
                $table->text('filter')->nullable();
				$table->json('wildcards');

				$table->timestamps();
                $table->softDeletes();

                $table->index('frequency_id', 'ix01_admin_report');
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
		Schema::dropIfExists('admin_report');
	}
}
