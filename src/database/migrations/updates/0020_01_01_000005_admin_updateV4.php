<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUpdateV4 extends Migration
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
        if(! Schema::hasColumn('admin_lang', 'object_id'))
        {
            // admin
            Schema::table('admin_country', function (Blueprint $table) {
                $table->dropForeign('fk01_admin_country');
            });
            Schema::table('admin_attachment', function (Blueprint $table) {
                $table->dropForeign('fk01_admin_attachment');
            });
            Schema::table('admin_field_value', function (Blueprint $table) {
                $table->dropForeign('fk01_admin_field_value');
            });
            Schema::table('admin_user', function (Blueprint $table) {
                $table->dropForeign('fk01_admin_user');
            });

            if(Schema::hasTable('cms_category'))
            {
                // cms
                Schema::table('cms_category', function (Blueprint $table) {
                    $table->dropForeign('fk01_cms_category');
                });
                Schema::table('cms_article', function (Blueprint $table) {
                    $table->dropForeign('fk01_cms_article');
                });
                Schema::table('cms_tag', function (Blueprint $table) {
                    $table->dropForeign('fk01_cms_tag');
                });
            }

            if(Schema::hasTable('crm_customer'))
            {
                // crm
                Schema::table('crm_customer', function (Blueprint $table) {
                    $table->dropForeign('fk06_crm_customer');
                });
            }

            if(Schema::hasTable('market_order_row'))
            {
                // market
                Schema::table('market_order_row', function (Blueprint $table) {
                    $table->dropForeign('fk01_market_order_row');
                });
                Schema::table('market_payment_method', function (Blueprint $table) {
                    $table->dropForeign('fk01_market_payment_method');
                });
                Schema::table('market_order_status', function (Blueprint $table) {
                    $table->dropForeign('fk01_market_order_status');
                });
                Schema::table('market_category', function (Blueprint $table) {
                    $table->dropForeign('fk01_market_category');
                });
                Schema::table('market_product_lang', function (Blueprint $table) {
                    $table->dropForeign('fk02_market_product_lang');
                });
            }



            Schema::table('admin_lang', function (Blueprint $table) {
                $table->dropPrimary('PRIMARY');
            });

            Schema::table('admin_lang', function (Blueprint $table) {
                $table->increments('ix')->first();
                $table->index('id', 'ix01_admin_lang');
            });



            // admin
            Schema::table('admin_country', function (Blueprint $table) {
                $table->foreign('lang_id', 'fk01_admin_country')
                    ->references('id')
                    ->on('admin_lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            });
            Schema::table('admin_attachment', function (Blueprint $table) {
                $table->foreign('lang_id', 'fk01_admin_attachment')
                    ->references('id')
                    ->on('admin_lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            });
            Schema::table('admin_field_value', function (Blueprint $table) {
                $table->foreign('lang_id', 'fk01_admin_field_value')
                    ->references('id')
                    ->on('admin_lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            });
            Schema::table('admin_user', function (Blueprint $table) {
                $table->foreign('lang_id', 'fk01_admin_user')
                    ->references('id')
                    ->on('admin_lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            });

            if(Schema::hasTable('cms_category'))
            {
                // cms
                Schema::table('cms_category', function (Blueprint $table) {
                    $table->foreign('lang_id', 'fk01_cms_category')
                        ->references('id')
                        ->on('admin_lang')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
                Schema::table('cms_article', function (Blueprint $table) {
                    $table->foreign('lang_id', 'fk01_cms_article')
                        ->references('id')
                        ->on('admin_lang')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
                Schema::table('cms_tag', function (Blueprint $table) {
                    $table->foreign('lang_id', 'fk01_cms_tag')
                        ->references('id')
                        ->on('admin_lang')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
            }

            if(Schema::hasTable('crm_customer'))
            {
                // crm
                Schema::table('crm_customer', function (Blueprint $table) {
                    $table->foreign('lang_id', 'fk06_crm_customer')
                        ->references('id')
                        ->on('admin_lang')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
            }

            if(Schema::hasTable('market_order_row'))
            {
                // market
                Schema::table('market_order_row', function (Blueprint $table) {
                    $table->foreign('lang_id', 'fk01_market_order_row')
                        ->references('id')
                        ->on('admin_lang')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
                Schema::table('market_payment_method', function (Blueprint $table) {
                    $table->foreign('lang_id', 'fk01_market_payment_method')
                        ->references('id')
                        ->on('admin_lang')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
                Schema::table('market_order_status', function (Blueprint $table) {
                    $table->foreign('lang_id', 'fk01_market_order_status')
                        ->references('id')
                        ->on('admin_lang')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
                Schema::table('market_category', function (Blueprint $table) {
                    $table->foreign('lang_id', 'fk01_market_category')
                        ->references('id')
                        ->on('admin_lang')
                        ->onDelete('restrict')
                        ->onUpdate('cascade');
                });
                Schema::table('market_product_lang', function (Blueprint $table) {
                    $table->foreign('lang_id', 'fk02_market_product_lang')
                        ->references('id')
                        ->on('admin_lang')
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