<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTablePackage extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('admin_package'))
		{
			Schema::create('admin_package', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->increments('id');
				$table->string('name');
				$table->string('root');
                $table->string('version')->nullable();
				$table->boolean('active')->default(false);
				$table->integer('sort')->unsigned();

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
	    Schema::dropIfExists('admin_package');
	}
}
