<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCreateTablePasswordResets extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('admin_password_resets'))
		{
			Schema::create('admin_password_resets', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->string('email', 150)->index();
				$table->string('token');
				$table->timestamp('created_at')->nullable();
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
		Schema::dropIfExists('admin_password_resets');
	}
}