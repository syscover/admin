<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
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

                $table->renameIndex('ix01_admin_field_value', 'admin_field_value_id_idx');
                $table->renameIndex('fk02_admin_field_value', 'admin_field_value_field_id_fk');
                $table->dropUnique('ui01_admin_field_value');
                $table->dropForeign('fk01_admin_field_value');
            });

            \Syscover\Admin\Models\Country::where('lang_id', 'de')->update([
                'lang_id' => 1
            ]);
            \Syscover\Admin\Models\Country::where('lang_id', 'en')->update([
                'lang_id' => 2
            ]);
            \Syscover\Admin\Models\Country::where('lang_id', 'es')->update([
                'lang_id' => 3
            ]);
            \Syscover\Admin\Models\Country::where('lang_id', 'fr')->update([
                'lang_id' => 4
            ]);

            DB::select(DB::raw('UPDATE admin_field_value set data_lang = REPLACE(data_lang, \'"de"\', 1);'));
            DB::select(DB::raw('UPDATE admin_field_value set data_lang = REPLACE(data_lang, \'"en"\', 2);'));
            DB::select(DB::raw('UPDATE admin_field_value set data_lang = REPLACE(data_lang, \'"es"\', 3);'));
            DB::select(DB::raw('UPDATE admin_field_value set data_lang = REPLACE(data_lang, \'"fr"\', 4);'));

            // refactor lang in admin_field
            DB::select(DB::raw('UPDATE admin_field set data_lang = REPLACE(data_lang, \'"de"\', 1);'));
            DB::select(DB::raw('UPDATE admin_field set data_lang = REPLACE(data_lang, \'"en"\', 2);'));
            DB::select(DB::raw('UPDATE admin_field set data_lang = REPLACE(data_lang, \'"es"\', 3);'));
            DB::select(DB::raw('UPDATE admin_field set data_lang = REPLACE(data_lang, \'"fr"\', 4);'));

            DB::select(DB::raw('UPDATE admin_field set labels = REPLACE(labels, \'"de"\', 1);'));
            DB::select(DB::raw('UPDATE admin_field set labels = REPLACE(labels, \'"en"\', 2);'));
            DB::select(DB::raw('UPDATE admin_field set labels = REPLACE(labels, \'"es"\', 3);'));
            DB::select(DB::raw('UPDATE admin_field set labels = REPLACE(labels, \'"fr"\', 4);'));


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

        if (SchemaService::hasIndex('admin_country', 'fk01_admin_country'))
        {
            Schema::table('admin_country', function (Blueprint $table) {
                $table->renameIndex('ix01_admin_country', 'admin_country_id_lang_id_idx');
                $table->renameIndex('ix02_admin_country', 'admin_country_slug_idx');
                $table->dropForeign('fk01_admin_country');
            });

            \Syscover\Admin\Models\Country::where('lang_id', 'de')->update([
                'lang_id' => 1
            ]);
            \Syscover\Admin\Models\Country::where('lang_id', 'en')->update([
                'lang_id' => 2
            ]);
            \Syscover\Admin\Models\Country::where('lang_id', 'es')->update([
                'lang_id' => 3
            ]);
            \Syscover\Admin\Models\Country::where('lang_id', 'fr')->update([
                'lang_id' => 4
            ]);

            DB::select(DB::raw('UPDATE admin_country set data_lang = REPLACE(data_lang, \'"de"\', 1);'));
            DB::select(DB::raw('UPDATE admin_country set data_lang = REPLACE(data_lang, \'"en"\', 2);'));
            DB::select(DB::raw('UPDATE admin_country set data_lang = REPLACE(data_lang, \'"es"\', 3);'));
            DB::select(DB::raw('UPDATE admin_country set data_lang = REPLACE(data_lang, \'"fr"\', 4);'));

            Schema::table('admin_country', function (Blueprint $table) {
                $table->integer('lang_id')->unsigned()->change();

                $table->foreign('lang_id', 'admin_country_lang_id_fk')
                    ->references('id')
                    ->on('admin_lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            });
        }

        if (SchemaService::hasIndex('admin_user', 'fk01_admin_user'))
        {
            Schema::table('admin_user', function (Blueprint $table) {
                $table->renameIndex('ui01_admin_user', 'admin_user_user_uq');
                $table->dropForeign('fk01_admin_user');
            });

            \Syscover\Admin\Models\User::where('lang_id', 'de')->update([
                'lang_id' => 1
            ]);
            \Syscover\Admin\Models\User::where('lang_id', 'en')->update([
                'lang_id' => 2
            ]);
            \Syscover\Admin\Models\User::where('lang_id', 'es')->update([
                'lang_id' => 3
            ]);
            \Syscover\Admin\Models\User::where('lang_id', 'fr')->update([
                'lang_id' => 4
            ]);

            Schema::table('admin_user', function (Blueprint $table) {
                $table->integer('lang_id')->unsigned()->change();

                $table->foreign('lang_id', 'admin_user_lang_id_fk')
                    ->references('id')
                    ->on('admin_lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            });
        }

        if (SchemaService::hasIndex('admin_attachment', 'fk01_admin_attachment'))
        {
            Schema::table('admin_attachment', function (Blueprint $table) {
                $table->renameIndex('ix01_admin_attachment', 'admin_attachment_id_lang_id_idx');
                $table->renameIndex('ix02_admin_attachment', 'admin_attachment_object_type_object_id_idx');
                $table->renameIndex('fk03_admin_attachment', 'admin_attachment_library_id_fk');
                $table->renameIndex('fk02_admin_attachment', 'admin_attachment_family_id_fk');
                $table->dropForeign('fk01_admin_attachment');
            });

            \Syscover\Admin\Models\Attachment::where('lang_id', 'de')->update([
                'lang_id' => 1
            ]);
            \Syscover\Admin\Models\Attachment::where('lang_id', 'en')->update([
                'lang_id' => 2
            ]);
            \Syscover\Admin\Models\Attachment::where('lang_id', 'es')->update([
                'lang_id' => 3
            ]);
            \Syscover\Admin\Models\Attachment::where('lang_id', 'fr')->update([
                'lang_id' => 4
            ]);

            Schema::table('admin_attachment', function (Blueprint $table) {
                $table->integer('lang_id')->unsigned()->change();

                $table->foreign('lang_id', 'admin_attachment_lang_id_fk')
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
