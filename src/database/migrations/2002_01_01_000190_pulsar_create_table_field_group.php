<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PulsarCreateTableFieldGroup extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('field_group'))
        {
            Schema::create('field_group', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->increments('id')->unsigned();
                $table->string('name')->nullable();
                $table->string('resource_id', 30);                             // resource which belong to this family field

                $table->foreign('resource_id', 'fk01_field_group')
                    ->references('id')
                    ->on('resource')
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
        Schema::dropIfExists('field_group');
    }
}
