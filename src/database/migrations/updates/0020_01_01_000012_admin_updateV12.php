<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminUpdateV12 extends Migration
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
        // get \Doctrine\DBAL\Schema\Table
	    $doctrineTable = Schema::getConnection()->getDoctrineSchemaManager()->listTableDetails('admin_attachment');

        // alter table "users" add constraint users_email_unique unique ("email")
        if ($doctrineTable->hasIndex('ix03_admin_attachment'))
        {
            Schema::table('admin_attachment', function (Blueprint $table) {
                $table->dropIndex('ix01_admin_attachment');
                $table->dropIndex('ix02_admin_attachment');
                $table->dropIndex('ix03_admin_attachment');

                DB::statement("ALTER TABLE admin_attachment MODIFY COLUMN object_type VARCHAR(255) AFTER lang_id");

                $table->index(['id', 'lang_id'], 'ix01_admin_attachment');
                $table->index(['object_type', 'object_id'], 'ix02_admin_attachment');
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