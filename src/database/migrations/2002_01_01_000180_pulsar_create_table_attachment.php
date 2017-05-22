<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PulsarCreateTableAttachment extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('attachment'))
        {
            Schema::create('attachment', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->integer('id')->unsigned();
                $table->string('lang_id', 2);
                $table->string('resource_id', 30);
                $table->integer('object_id')->unsigned()->nullable();
                $table->integer('family_id')->unsigned()->nullable();
                $table->integer('sort')->unsigned()->nullable();
                $table->string('name');
                $table->string('file_name');
                $table->string('url', 1024);                                // url to access file
                $table->string('mime');
                $table->integer('size')->unsigned();
                $table->smallInteger('width')->unsigned()->nullable();
                $table->smallInteger('height')->unsigned()->nullable();
                $table->integer('library_id')->unsigned()->nullable();              // original element in library
                $table->string('library_file_name')->nullable();
                $table->json('data_lang')->nullable();
                $table->json('data')->nullable();
                
                $table->foreign('lang_id', 'fk01_attachment')
                    ->references('id')
                    ->on('lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('resource_id', 'fk02_attachment')
                    ->references('id')
                    ->on('resource')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                $table->foreign('family_id', 'fk03_attachment')
                    ->references('id')
                    ->on('attachment_family')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('library_id', 'fk04_attachment')
                    ->references('id')
                    ->on('attachment_library')
                    ->onDelete('set null')
                    ->onUpdate('cascade');

                $table->index(['object_id'], 'ix01_attachment');
                $table->index(['resource_id'], 'ix02_attachment');
                $table->primary(['id', 'lang_id'], 'pk01_attachment');
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
        Schema::dropIfExists('attachment');
    }
}
