<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTableCountry extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(! Schema::hasTable('admin_country'))
        {
            Schema::create('admin_country', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->string('id', 2);
                $table->string('lang_id', 2);
                $table->string('name');
                $table->smallInteger('sort')->unsigned();
                $table->string('prefix', 5)->nullable();
                $table->string('territorial_area_1', 50)->nullable();
                $table->string('territorial_area_2', 50)->nullable();
                $table->string('territorial_area_3', 50)->nullable();
                $table->json('data_lang')->nullable();

                $table->timestamps();
                $table->softDeletes();
                
                $table->foreign('lang_id', 'fk01_admin_country')
                    ->references('id')
                    ->on('admin_lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                
                $table->primary(['id', 'lang_id'], 'pk01_admin_country');
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
        Schema::dropIfExists('admin_country');
	}
}