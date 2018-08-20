<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUpdateV5 extends Migration
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
        if(! Schema::hasColumn('admin_country', 'ix'))
        {
            // admin
            Schema::table('admin_territorial_area_1', function (Blueprint $table) {
                $table->dropForeign('fk01_admin_territorial_area_1');
            });
            Schema::table('admin_territorial_area_2', function (Blueprint $table) {
                $table->dropForeign('fk01_admin_territorial_area_2');
            });
            Schema::table('admin_territorial_area_3', function (Blueprint $table) {
                $table->dropForeign('fk01_admin_territorial_area_3');
            });

            if(Schema::hasTable('crm_customer'))
            {
                // crm
                Schema::table('crm_customer', function (Blueprint $table) {
                    $table->dropForeign('fk02_crm_customer');
                });
                Schema::table('crm_address', function (Blueprint $table) {
                    $table->dropForeign('fk03_crm_address');
                });
            }

            if(Schema::hasTable('market_order_row'))
            {
                // market
                Schema::table('market_order', function (Blueprint $table) {
                    $table->dropForeign('fk05_market_order');
                });
                Schema::table('market_order', function (Blueprint $table) {
                    $table->dropForeign('fk09_market_order');
                });
                Schema::table('market_warehouse', function (Blueprint $table) {
                    $table->dropForeign('fk01_market_warehouse');
                });
                Schema::table('market_tax_rate_zone', function (Blueprint $table) {
                    $table->dropForeign('fk01_market_tax_rate_zone');
                });
            }



            Schema::table('admin_country', function (Blueprint $table) {
                $table->dropPrimary('PRIMARY');
            });

            Schema::table('admin_country', function (Blueprint $table) {
                $table->increments('ix')->first();
                $table->index(['id', 'lang_id'], 'ix01_admin_country');
            });



            // admin
            Schema::table('admin_territorial_area_1', function (Blueprint $table) {
                $table->foreign('country_id', 'fk01_admin_territorial_area_1')
                    ->references('id')
                    ->on('admin_country')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            });
            Schema::table('admin_territorial_area_2', function (Blueprint $table) {
                $table->foreign('country_id', 'fk01_admin_territorial_area_2')
                    ->references('id')
                    ->on('admin_country')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            });
            Schema::table('admin_territorial_area_3', function (Blueprint $table) {
                $table->foreign('country_id', 'fk01_admin_territorial_area_3')
                    ->references('id')
                    ->on('admin_country')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            });

            if(Schema::hasTable('crm_customer'))
            {
                // crm
                Schema::table('crm_customer', function (Blueprint $table) {
                    $table->foreign('country_id', 'fk02_crm_customer')
                        ->references('id')
                        ->on('admin_country')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
                Schema::table('crm_address', function (Blueprint $table) {
                    $table->foreign('country_id', 'fk03_crm_address')
                        ->references('id')
                        ->on('admin_country')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
            }

            if(Schema::hasTable('market_order'))
            {
                // market
                Schema::table('market_order', function (Blueprint $table) {
                    $table->foreign('invoice_country_id', 'fk05_market_order')
                        ->references('id')
                        ->on('admin_country')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
                Schema::table('market_order', function (Blueprint $table) {
                    $table->foreign('shipping_country_id', 'fk09_market_order')
                        ->references('id')
                        ->on('admin_country')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });

                Schema::table('market_warehouse', function (Blueprint $table) {
                    $table->foreign('country_id', 'fk01_market_warehouse')
                        ->references('id')
                        ->on('admin_country')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
                Schema::table('market_tax_rate_zone', function (Blueprint $table) {
                    $table->foreign('country_id', 'fk01_market_tax_rate_zone')
                        ->references('id')
                        ->on('admin_country')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
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