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
				
				$table->increments('id')->unsigned();

                $table->string('subject');
                $table->json('emails');
                $table->json('cc')->nullable();

                $table->string('schedule_frequency')->nullable();

                $table->string('filename');
                $table->string('extension');

                $table->text('sql');

				$table->timestamps();
                $table->softDeletes();

                $table->index('schedule_frequency', 'ix01_admin_report');
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