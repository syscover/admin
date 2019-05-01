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

                $table->unique(['id', 'lang_id', 'field_id'], 'admin_field_value_id_lang_id_field_id_uq');
                $table->index('id', 'admin_field_value_id_idx');

                $table->foreign('lang_id', 'admin_field_value_lang_id_fk')
                    ->references('id')
                    ->on('admin_lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('field_id', 'admin_field_value_field_id_fk')
                    ->references('id')
                    ->on('admin_field')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
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
