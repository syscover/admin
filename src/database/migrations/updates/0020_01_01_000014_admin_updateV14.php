<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Syscover\Core\Services\SchemaService;

class AdminUpdateV14 extends Migration
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
        if (SchemaService::hasIndex('admin_lang', 'ui01_admin_lang'))
        {
            Schema::table('admin_lang', function (Blueprint $table) {
                $table->renameColumn('id', 'code');
                $table->renameColumn('ix', 'id');
                $table->renameIndex('ui01_admin_lang', 'admin_lang_code_uq');
            });
        }


        if (SchemaService::hasIndex('admin_field_value', 'fk01_admin_field_value'))
        {
            Schema::table('admin_field_value', function (Blueprint $table) {

                $table->dropUnique('ui01_admin_field_value');
                $table->dropForeign('fk01_admin_field_value');

            });

            \Syscover\Admin\Models\FieldValue::where('lang_id', 'es')->update([
                'lang_id' => 3
            ]);
            \Syscover\Admin\Models\FieldValue::where('lang_id', 'en')->update([
                'lang_id' => 2
            ]);

            Schema::table('admin_field_value', function (Blueprint $table) {

                $table->integer('lang_id')->unsigned()->change();

                $table->unique(['id', 'lang_id', 'field_id'], 'admin_field_value_id_lang_id_field_id_uq');
                $table->foreign('lang_id', 'admin_field_value_lang_id_fk')
                    ->references('id')
                    ->on('admin_lang')
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
	public function down(){}
}
