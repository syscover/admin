<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AdminCreateTableUser extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(! Schema::hasTable('admin_user'))
        {
            Schema::create('admin_user', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->string('surname')->nullable();
                $table->string('lang_id', 2);
                $table->string('email', 150);
                $table->integer('profile_id')->unsigned();
                $table->boolean('access');
                $table->string('user', 150);
                $table->string('password');
                $table->string('remember_token')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->unique('user', 'ui01_admin_user');

                $table->foreign('lang_id', 'fk01_admin_user')
                    ->references('id')
                    ->on('admin_lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('profile_id', 'fk02_admin_user')
                    ->references('id')
                    ->on('admin_profile')
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
        Schema::dropIfExists('admin_user');
	}
}