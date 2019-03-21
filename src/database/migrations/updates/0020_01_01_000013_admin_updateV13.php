<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Syscover\Core\Services\SchemaService;

class AdminUpdateV13 extends Migration
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
        if (SchemaService::hasIndex('admin_lang', 'ix01_admin_lang'))
        {
            Schema::table('admin_lang', function (Blueprint $table) {

                $table->dropIndex('ix01_admin_lang');
                $table->unique('id', 'ui01_admin_lang');
            });
        }

        if (SchemaService::hasIndex('admin_resource', 'ix01_admin_resource'))
        {
            Schema::table('admin_resource', function (Blueprint $table) {

                $table->dropIndex('ix01_admin_resource');
                $table->unique('id', 'ui01_admin_resource');
            });
        }

        if (SchemaService::hasIndex('admin_territorial_area_1', 'ix01_admin_territorial_area_1'))
        {
            Schema::table('admin_territorial_area_1', function (Blueprint $table) {

                $table->dropIndex('ix01_admin_territorial_area_1');
                $table->unique('id', 'ui01_admin_territorial_area_1');
            });
        }

        if (SchemaService::hasIndex('admin_territorial_area_2', 'ix01_admin_territorial_area_2'))
        {
            Schema::table('admin_territorial_area_2', function (Blueprint $table) {

                $table->dropIndex('ix01_admin_territorial_area_2');
                $table->unique('id', 'ui01_admin_territorial_area_2');
            });
        }

        if (SchemaService::hasIndex('admin_territorial_area_3', 'ix01_admin_territorial_area_3'))
        {
            Schema::table('admin_territorial_area_3', function (Blueprint $table) {

                $table->dropIndex('ix01_admin_territorial_area_3');
                $table->unique('id', 'ui01_admin_territorial_area_3');
            });
        }

        if (! Schema::hasColumn('admin_country', 'latitude'))
        {
            Schema::table('admin_country', function (Blueprint $table) {
                $table->decimal('latitude', 17, 14)->nullable()->after('territorial_area_3');
            });
        }

        if (! Schema::hasColumn('admin_country', 'longitude'))
        {
            Schema::table('admin_country', function (Blueprint $table) {
                $table->decimal('longitude', 17, 14)->nullable()->after('latitude');
            });
        }

        if (! Schema::hasColumn('admin_country', 'zoom'))
        {
            Schema::table('admin_country', function (Blueprint $table) {
                $table->tinyInteger('zoom')->nullable()->after('longitude');
            });
        }

        if (! Schema::hasColumn('admin_attachment_family', 'fit_type'))
        {
            Schema::table('admin_attachment_family', function (Blueprint $table) {
                $table->tinyInteger('fit_type')->unsigned()->default(1)->after('height');
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
