<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PulsarCreateTableField extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('field'))
        {
            Schema::create('field', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->increments('id')->unsigned();
                $table->integer('group_id')->unsigned();
                $table->string('name')->nullable();
                
                // lang set in json on data
                // label set in json on data

                $table->tinyInteger('field_type_id')->unsigned(); // see config/pulsar.php
                $table->string('field_type_name');
                // 1 - Text
                // 2 - Select
                // 3 - Select multiple
                // 4 - Number
                // 5 - Email
                // 6 - Checkbox
                // 7 - Select 2
                // 8 - Select 2 multiple
                // 9 - Text area
                // 10 - Wysiwyg

                $table->tinyInteger('data_type_id')->unsigned();
                $table->string('data_type_name');
                // 1 - String
                // 2 - Boolean
                // 3 - Integer
                // 4 - Float
                // 5 - Array
                // 6 - Object

                $table->boolean('required');
                $table->smallInteger('sorting')->unsigned()->nullable();
                $table->integer('max_length')->unsigned()->nullable();
                $table->string('pattern')->nullable()->nullable();
                $table->tinyInteger('label_size')->unsigned()->nullable();  // column bootstrap size
                $table->tinyInteger('field_size')->unsigned()->nullable();  // column bootstrap size
                $table->text('data_lang')->nullable();
                $table->text('data')->nullable();

                $table->foreign('group_id', 'fk01_field')
                    ->references('id')
                    ->on('field_group')
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
        Schema::dropIfExists('field');
    }
}
