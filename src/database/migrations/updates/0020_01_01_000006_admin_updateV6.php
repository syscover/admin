<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUpdateV6 extends Migration
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
        if(! Schema::hasColumn('admin_territorial_area_1', 'ix'))
        {
            // admin
            Schema::table('admin_territorial_area_2', function (Blueprint $table) {
                $table->dropForeign('fk02_admin_territorial_area_2');
            });
            Schema::table('admin_territorial_area_3', function (Blueprint $table) {
                $table->dropForeign('fk02_admin_territorial_area_3');
                $table->dropForeign('fk03_admin_territorial_area_3');
            });

            if(Schema::hasTable('crm_customer'))
            {
                // crm
                Schema::table('crm_customer', function (Blueprint $table) {
                    $table->dropForeign('fk03_crm_customer');
                    $table->dropForeign('fk04_crm_customer');
                    $table->dropForeign('fk05_crm_customer');
                });
                Schema::table('crm_address', function (Blueprint $table) {
                    $table->dropForeign('fk04_crm_address');
                    $table->dropForeign('fk05_crm_address');
                    $table->dropForeign('fk06_crm_address');
                });
            }

            if(Schema::hasTable('market_order'))
            {
                // market
                Schema::table('market_order', function (Blueprint $table) {
                    $table->dropForeign('fk06_market_order');
                    $table->dropForeign('fk07_market_order');
                    $table->dropForeign('fk08_market_order');
                    $table->dropForeign('fk10_market_order');
                    $table->dropForeign('fk11_market_order');
                    $table->dropForeign('fk12_market_order');
                });
                Schema::table('market_warehouse', function (Blueprint $table) {
                    $table->dropForeign('fk02_market_warehouse');
                    $table->dropForeign('fk03_market_warehouse');
                    $table->dropForeign('fk04_market_warehouse');
                });
                Schema::table('market_tax_rate_zone', function (Blueprint $table) {
                    $table->dropForeign('fk02_market_tax_rate_zone');
                    $table->dropForeign('fk03_market_tax_rate_zone');
                    $table->dropForeign('fk04_market_tax_rate_zone');
                });
            }



            Schema::table('admin_territorial_area_1', function (Blueprint $table) {
                $table->dropPrimary('PRIMARY');
            });
            Schema::table('admin_territorial_area_1', function (Blueprint $table) {
                $table->increments('ix')->first();
                $table->index('id', 'ix01_admin_territorial_area_1');
            });
            Schema::table('admin_territorial_area_2', function (Blueprint $table) {
                $table->dropPrimary('PRIMARY');
            });
            Schema::table('admin_territorial_area_2', function (Blueprint $table) {
                $table->increments('ix')->first();
                $table->index('id', 'ix01_admin_territorial_area_2');
            });
            Schema::table('admin_territorial_area_3', function (Blueprint $table) {
                $table->dropPrimary('PRIMARY');
            });
            Schema::table('admin_territorial_area_3', function (Blueprint $table) {
                $table->increments('ix')->first();
                $table->index('id', 'ix01_admin_territorial_area_3');
            });



            // admin
            Schema::table('admin_territorial_area_2', function (Blueprint $table) {
                $table->foreign('territorial_area_1_id', 'fk02_admin_territorial_area_2')
                    ->references('id')
                    ->on('admin_territorial_area_1')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            });
            Schema::table('admin_territorial_area_3', function (Blueprint $table) {
                $table->foreign('territorial_area_1_id', 'fk02_admin_territorial_area_3')
                    ->references('id')
                    ->on('admin_territorial_area_1')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('territorial_area_2_id', 'fk03_admin_territorial_area_3')
                    ->references('id')
                    ->on('admin_territorial_area_2')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            });

            if(Schema::hasTable('crm_customer'))
            {
                // crm
                Schema::table('crm_customer', function (Blueprint $table) {
                    $table->foreign('territorial_area_1_id', 'fk03_crm_customer')
                        ->references('id')
                        ->on('admin_territorial_area_1')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('territorial_area_2_id', 'fk04_crm_customer')
                        ->references('id')
                        ->on('admin_territorial_area_2')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('territorial_area_3_id', 'fk05_crm_customer')
                        ->references('id')
                        ->on('admin_territorial_area_3')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
                Schema::table('crm_address', function (Blueprint $table) {
                    $table->foreign('territorial_area_1_id', 'fk04_crm_address')
                        ->references('id')
                        ->on('admin_territorial_area_1')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('territorial_area_2_id', 'fk05_crm_address')
                        ->references('id')
                        ->on('admin_territorial_area_2')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('territorial_area_3_id', 'fk06_crm_address')
                        ->references('id')
                        ->on('admin_territorial_area_3')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
            }

            if(Schema::hasTable('market_order'))
            {
                // market
                Schema::table('market_order', function (Blueprint $table) {
                    $table->foreign('invoice_territorial_area_1_id', 'fk06_market_order')
                        ->references('id')
                        ->on('admin_territorial_area_1')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('invoice_territorial_area_2_id', 'fk07_market_order')
                        ->references('id')
                        ->on('admin_territorial_area_2')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('invoice_territorial_area_3_id', 'fk08_market_order')
                        ->references('id')
                        ->on('admin_territorial_area_3')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('shipping_territorial_area_1_id', 'fk10_market_order')
                        ->references('id')
                        ->on('admin_territorial_area_1')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('shipping_territorial_area_2_id', 'fk11_market_order')
                        ->references('id')
                        ->on('admin_territorial_area_2')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('shipping_territorial_area_3_id', 'fk12_market_order')
                        ->references('id')
                        ->on('admin_territorial_area_3')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
                Schema::table('market_warehouse', function (Blueprint $table) {
                    $table->foreign('territorial_area_1_id', 'fk02_market_warehouse')
                        ->references('id')
                        ->on('admin_territorial_area_1')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('territorial_area_2_id', 'fk03_market_warehouse')
                        ->references('id')
                        ->on('admin_territorial_area_2')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('territorial_area_3_id', 'fk04_market_warehouse')
                        ->references('id')
                        ->on('admin_territorial_area_3')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
                Schema::table('market_tax_rate_zone', function (Blueprint $table) {
                    $table->foreign('territorial_area_1_id', 'fk02_market_tax_rate_zone')
                        ->references('id')
                        ->on('admin_territorial_area_1')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('territorial_area_2_id', 'fk03_market_tax_rate_zone')
                        ->references('id')
                        ->on('admin_territorial_area_2')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                    $table->foreign('territorial_area_3_id', 'fk04_market_tax_rate_zone')
                        ->references('id')
                        ->on('admin_territorial_area_3')
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