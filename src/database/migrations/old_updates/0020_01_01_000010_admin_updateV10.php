<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUpdateV10 extends Migration
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
        Schema::table('admin_user', function (Blueprint $table) {
            $table->boolean('access')->default(false)->change();
        });

        Schema::table('admin_lang', function (Blueprint $table) {
            $table->boolean('active')->default(false)->change();
        });

        Schema::table('admin_package', function (Blueprint $table) {
            $table->boolean('active')->default(false)->change();
        });

        Schema::table('admin_field', function (Blueprint $table) {
            $table->boolean('required')->default(false)->change();
        });

        Schema::table('admin_field_value', function (Blueprint $table) {
            $table->boolean('featured')->default(false)->change();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){}
}