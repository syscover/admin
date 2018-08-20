<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUpdateV8 extends Migration
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
        if(! Schema::hasColumn('admin_country', 'slug'))
        {
            Schema::table('admin_country', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name');
                $table->index('slug', 'ix02_admin_country');
            });
            Schema::table('admin_territorial_area_1', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name');
                $table->index('slug', 'ix02_admin_territorial_area_1');
            });
            Schema::table('admin_territorial_area_2', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name');
                $table->index('slug', 'ix02_admin_territorial_area_2');
            });
            Schema::table('admin_territorial_area_3', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('name');
                $table->index('slug', 'ix02_admin_territorial_area_3');
            });

            $countries = \Syscover\Admin\Models\Country::all();
            foreach ($countries as $country) {
                \Syscover\Admin\Models\Country::where('ix', $country->ix)->update([
                    'slug' => str_slug($country->name)
                ]);
            }

            $tas1 = \Syscover\Admin\Models\TerritorialArea1::all();
            foreach ($tas1 as $ta1) {
                \Syscover\Admin\Models\TerritorialArea1::where('ix', $ta1->ix)->update([
                    'slug' => str_slug($ta1->name)
                ]);
            }

            $tas2 = \Syscover\Admin\Models\TerritorialArea2::all();
            foreach ($tas2 as $ta2) {
                \Syscover\Admin\Models\TerritorialArea2::where('ix', $ta2->ix)->update([
                    'slug' => str_slug($ta2->name)
                ]);
            }

            $tas3 = \Syscover\Admin\Models\TerritorialArea3::all();
            foreach ($tas3 as $ta3) {
                \Syscover\Admin\Models\TerritorialArea3::where('ix', $ta3->ix)->update([
                    'slug' => str_slug($ta3->name)
                ]);
            }
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){}
}