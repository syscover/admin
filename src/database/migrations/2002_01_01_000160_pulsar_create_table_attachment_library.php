<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PulsarCreateTableAttachmentLibrary extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('attachment_library'))
        {
            Schema::create('attachment_library', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->increments('id')->unsigned();
                $table->string('resource_id', 30);                              // resource which belong to this attachment
                $table->string('url', 1020)->nullable();
                $table->string('file_name', 1020)->nullable();
                $table->string('mime');
                $table->integer('size')->unsigned();
                $table->tinyInteger('type_id')->unsigned();                             // 1 = image, 2 = file, 3 = video
                $table->string('type_text');

                $table->smallInteger('width')->unsigned()->nullable();
                $table->smallInteger('height')->unsigned()->nullable();
                $table->text('data')->nullable();

                $table->foreign('resource_id', 'fk01_attachment_library')
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
        Schema::dropIfExists('attachment_library');
    }
}
