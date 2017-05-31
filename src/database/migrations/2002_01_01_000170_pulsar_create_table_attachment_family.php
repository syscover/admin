<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PulsarCreateTableAttachmentFamily extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('attachment_family'))
        {
            Schema::create('attachment_family', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->increments('id')->unsigned();
                $table->string('resource_id', 30); // resource which belong to this attachment
                $table->string('name');
                $table->smallInteger('width')->unsigned()->nullable();
                $table->smallInteger('height')->unsigned()->nullable();
                $table->json('sizes')->nullable();

                $table->foreign('resource_id', 'fk01_attachment_family')
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
        Schema::dropIfExists('attachment_family');
    }
}
