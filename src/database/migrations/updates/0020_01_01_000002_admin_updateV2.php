<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUpdateV2 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(! Schema::hasColumn('admin_resource', 'object_id'))
        {
            Schema::table('admin_permission', function (Blueprint $table) {
                $table->dropForeign('fk02_admin_permission');
            });

            Schema::table('admin_attachment_family', function (Blueprint $table) {
                $table->dropForeign('fk01_admin_attachment_family');
            });

            Schema::table('admin_attachment_mime', function (Blueprint $table) {
                $table->dropForeign('fk01_admin_attachment_mime');
            });

            Schema::table('admin_field_group', function (Blueprint $table) {
                $table->dropForeign('fk01_admin_field_group');
            });


            Schema::table('admin_resource', function (Blueprint $table) {
                $table->dropPrimary('PRIMARY');
                $table->renameColumn('id', 'object_id');
            });

            Schema::table('admin_resource', function (Blueprint $table) {
                $table->increments('id')->first();
                $table->index('object_id', 'ix01_admin_resource');

            });


            Schema::table('admin_permission', function (Blueprint $table) {
                $table->foreign('resource_id', 'fk02_admin_permission')
                    ->references('object_id')
                    ->on('admin_resource')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });

            Schema::table('admin_attachment_family', function (Blueprint $table) {
                $table->foreign('resource_id', 'fk01_admin_attachment_family')
                    ->references('object_id')
                    ->on('admin_resource')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });

            Schema::table('admin_attachment_mime', function (Blueprint $table) {
                $table->foreign('resource_id', 'fk01_admin_attachment_mime')
                    ->references('object_id')
                    ->on('admin_resource')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });

            Schema::table('admin_field_group', function (Blueprint $table) {
                $table->foreign('resource_id', 'fk01_admin_field_group')
                    ->references('object_id')
                    ->on('admin_resource')
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