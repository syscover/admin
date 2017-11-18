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
        if(! Schema::hasColumn('admin_country', 'obj_id'))
        {
            Schema::table('admin_country', function (Blueprint $table) {
                //$table->dropPrimary('pk01_admin_country');
                //$table->renameColumn('id', 'obj_id');

//                $table->integer('id')->unsigned();
//                $table->primary('id', 'pk01_admin_country');
//
//                $table->index(['obj_id', 'lang_id'], 'ix01_admin_country');
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