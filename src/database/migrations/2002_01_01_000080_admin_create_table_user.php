<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PulsarCreateTableUser extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(! Schema::hasTable('user'))
        {
            Schema::create('user', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->string('surname')->nullable();
                $table->string('lang_id', 2);
                $table->string('email');
                $table->integer('profile_id')->unsigned();
                $table->boolean('access');
                $table->string('user');
                $table->string('password');
                $table->string('remember_token')->nullable();

                $table->timestamps();

                $table->foreign('lang_id', 'fk01_user')
                    ->references('id')
                    ->on('lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('profile_id', 'fk02_user')
                    ->references('id')
                    ->on('profile')
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
        if (Schema::hasTable('user'))
        {
            Schema::drop('user');
        }
	}
}