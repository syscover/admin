<?php

use Illuminate\Database\Migrations\Migration;

class PulsarCreateTableReportTask extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('report_task'))
		{
			Schema::create('report_task', function ($table) {
				$table->engine = 'InnoDB';

				$table->increments('id')->unsigned();
				$table->integer('date')->unsigned();
				$table->integer('user_id')->unsigned();

                $table->string('email');
                $table->text('cc')->nullable(); // emails to send copy
                $table->string('subject');

                $table->string('filename');
                $table->string('extension_file');

                // 1 - one time
                // 2 - daily
                // 3 - weekly
                // 4 - monthly
                // 5 - quarterly
                $table->tinyInteger('frequency')->unsigned();

                // if frequency is one time, you can define data range
                $table->integer('from')->unsigned()->nullable();    // this field will be replace by #FROM# in query
                $table->integer('until')->unsigned()->nullable();   // this field will be replace by #UNTIL# in query

                // if frequency is daily, weekly, monthly or quarterly, you can define day of week or day of month to delivery report
                $table->tinyInteger('delivery_day')->unsigned()->nullable();

                $table->integer('last_run')->unsigned()->nullable();
                $table->integer('next_run')->unsigned()->nullable();

				$table->text('parameters')->nullable();
                $table->text('sql');

				$table->foreign('user_id', 'fk01_report_task')
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
		Schema::dropIfExists('report_task');
	}
}