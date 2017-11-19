<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUpdateV1 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(! Schema::hasColumn('admin_action', 'object_id'))
        {
            Schema::table('admin_permission', function (Blueprint $table) {
                $table->dropForeign('fk03_admin_permission');
            });

            Schema::table('admin_action', function (Blueprint $table) {
                $table->dropPrimary('PRIMARY');
                $table->renameColumn('id', 'object_id');
            });

            Schema::table('admin_action', function (Blueprint $table) {
                $table->increments('id')->first();
                $table->index('object_id', 'ix01_admin_action');

            });

            Schema::table('admin_permission', function (Blueprint $table) {
                $table->foreign('action_id', 'fk03_admin_permission')
                    ->references('object_id')
                    ->on('admin_action')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){}
}