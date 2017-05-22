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
                $table->string('name');                         // original image name
                $table->string('file_name');                    // file name in laravel storage
                $table->string('url', 1024);             // url to access file
                $table->string('mime');                         // mime type
                $table->integer('size')->unsigned();            // size in bytes
                $table->smallInteger('width')->unsigned()->nullable();
                $table->smallInteger('height')->unsigned()->nullable();
                $table->json('data')->nullable();
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
