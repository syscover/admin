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
                $table->string('resource_id', 30);                                  // resource which belong to this attachment
                $table->integer('object_id')->unsigned()->nullable();
                $table->integer('family_id')->unsigned()->nullable();
                $table->integer('library_id')->unsigned()->nullable();              // original element library
                $table->string('library_file_name', 1020)->nullable();
                $table->integer('sorting')->unsigned()->nullable();
                $table->string('url', 1020)->nullable();
                $table->string('name')->nullable();
                $table->string('file_name', 1020)->nullable();
                $table->string('mime')->nullable();
                $table->integer('size')->unsigned()->nullable();
                $table->tinyInteger('type_id')->unsigned();                         // 1 = image, 2 = file, 3 = video
                $table->string('type_text');
                $table->smallInteger('width')->unsigned()->nullable();
                $table->smallInteger('height')->unsigned()->nullable();
                $table->text('data_lang')->nullable();
                $table->text('data')->nullable();
                
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

                $table->index(['object_id'], 'pk01_attachment');
                $table->primary(['id', 'lang_id'], 'ix01_attachment');
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
