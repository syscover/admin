<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUpdateV3 extends Migration
{
    public function __construct()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('json', 'string');
    }

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(! Schema::hasColumn('admin_field_value', 'ix'))
        {
            Schema::table('admin_field_value', function (Blueprint $table) {
                $table->dropPrimary('PRIMARY');
            });

            Schema::table('admin_field_value', function (Blueprint $table) {
                $table->increments('ix')->first();
                $table->unique(['id', 'lang_id', 'field_id'], 'ui01_admin_field_value');
                $table->index('id', 'ix01_admin_field_value');
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