<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PulsarCreateTableFieldResult extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('field_result'))
        {
            Schema::create('field_result', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->increments('id')->unsigned();
                $table->integer('object_id')->unsigned();      // ID of record who owns the result
                $table->string('lang_id', 2);
                $table->string('resource_id', 30);
                $table->integer('field_id')->unsigned();
                
                // data type
                // 1 - String
                // 2 - Boolean
                // 3 - Integer
                // 4 - Float
                // 5 - Array
                // 6 - Object
                $table->string('data_type_type')->default('string');
                $table->longText('value');
                
                $table->foreign('lang_id', 'fk01_field_result')
                    ->references('id')
                    ->on('lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('field_id', 'fk02_field_result')
                    ->references('id')
                    ->on('field')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                $table->foreign('resource_id', 'fk03_field_result')
                    ->references('id')
                    ->on('resource')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                $table->index(['lang_id', 'field_id', 'resource_id', 'object_id'], 'pk01_field_result');
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
        Schema::dropIfExists('field_result');
    }
}
