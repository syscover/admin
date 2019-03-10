<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCreateTableFieldValue extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('admin_field_value'))
        {
            Schema::create('admin_field_value', function (Blueprint $table) {
                $table->engine = 'InnoDB';

                $table->increments('ix');
                $table->string('id', 30);

                // counter to assign number to id if has not ID
                $table->integer('counter')->unsigned()->nullable();

                $table->string('lang_id', 2);
                $table->integer('field_id')->unsigned();
                $table->string('name');
                $table->smallInteger('sort')->unsigned()->nullable();
                $table->boolean('featured')->default(false);
                $table->json('data_lang')->nullable();
                $table->json('data')->nullable();

                $table->timestamps();
                $table->softDeletes();
                
                $table->foreign('lang_id', 'fk01_admin_field_value')
                    ->references('id')
                    ->on('admin_lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('field_id', 'fk02_admin_field_value')
                    ->references('id')
                    ->on('admin_field')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->unique(['id', 'lang_id', 'field_id'], 'ui01_admin_field_value');
                $table->index('id', 'ix01_admin_field_value');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_field_value');
    }
}
