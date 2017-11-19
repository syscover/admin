<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCreateTableField extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('admin_field'))
        {
            Schema::create('admin_field', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->increments('id');
                $table->integer('field_group_id')->unsigned();
                $table->string('name')->nullable();
                $table->text('labels')->nullable(); // To save label values in different languages

                $table->string('field_type_id', 50); // see config/pulsar-admin.php
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

                $table->tinyInteger('data_type_id')->unsigned(); // see config/pulsar-admin.php
                $table->string('data_type_name');
                // 1 - String
                // 2 - Boolean
                // 3 - Integer
                // 4 - Float
                // 5 - Array
                // 6 - Object

                $table->boolean('required');
                $table->smallInteger('sort')->unsigned()->nullable();
                $table->integer('max_length')->unsigned()->nullable();
                $table->string('pattern')->nullable()->nullable();
                $table->string('label_class')->nullable();      // class style for label
                $table->string('component_class')->nullable();  // class style for component
                $table->json('data_lang')->nullable(); // Set different langs in json
                $table->json('data')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('field_group_id', 'fk01_admin_field')
                    ->references('id')
                    ->on('admin_field_group')
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
        Schema::dropIfExists('admin_field');
    }
}
