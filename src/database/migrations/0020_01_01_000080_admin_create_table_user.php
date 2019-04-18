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
                
                $table->increments('id');
                $table->string('name');
                $table->string('surname')->nullable();
                $table->integer('lang_id')->unsigned();
                $table->string('email');
                $table->integer('profile_id')->unsigned();
                $table->boolean('active')->default(false);
                $table->string('user', 150);
                $table->string('password');
                $table->string('remember_token')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->unique('user', 'admin_user_user_uq');

                $table->foreign('lang_id', 'admin_user_lang_id_fk')
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
