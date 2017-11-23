<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUpdateV7 extends Migration
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
        if(! Schema::hasColumn('admin_attachment', 'ix'))
        {
            Schema::table('admin_attachment', function (Blueprint $table) {
                $table->dropPrimary('PRIMARY');
            });
            Schema::table('admin_attachment', function (Blueprint $table) {
                $table->increments('ix')->first();
                $table->index(['id', 'lang_id'], 'ix03_admin_attachment');
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