<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCreateTableLang extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('admin_lang'))
		{
			Schema::create('admin_lang', function (Blueprint $table) {
				$table->engine = 'InnoDB';

                $table->increments('ix');
                $table->string('id', 2);
				$table->string('name');
				$table->string('icon')->nullable();
				$table->smallInteger('sort')->unsigned();
				$table->boolean('active')->default(false);

                $table->timestamps();
                $table->softDeletes();

                $table->unique('id', 'admin_lang_id_uq');
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
        Schema::dropIfExists('admin_lang');
	}
}
