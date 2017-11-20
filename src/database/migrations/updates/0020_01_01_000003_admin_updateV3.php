<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUpdateV3 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(Schema::hasColumn('admin_permission', 'resource_id'))
        {
            Schema::table('admin_permission', function (Blueprint $table) {
                $table->renameColumn('resource_id', 'resource_object_id');
                $table->renameColumn('action_id', 'action_object_id');
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