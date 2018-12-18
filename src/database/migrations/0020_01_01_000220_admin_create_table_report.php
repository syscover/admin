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
                $table->json('cc');

                $table->string('filename');
                $table->string('extension');

                $table->text('sql');

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
		Schema::dropIfExists('admin_report');
	}
}