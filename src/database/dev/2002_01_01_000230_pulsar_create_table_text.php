<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PulsarCreateTableText extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(! Schema::hasTable('text'))
        {
            Schema::create('text', function (Blueprint $table) {
                $table->engine = 'InnoDB';

                $table->integer('id')->unsigned();
                $table->string('lang_id', 2);
                $table->text('text')->nullable();
                
                $table->foreign('lang_id', 'fk01_text')
                    ->references('id')
                    ->on('lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

                $table->primary(['id', 'lang_id'], 'pk01_text');
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
        Schema::dropIfExists('text');
	}
}