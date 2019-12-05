<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCreateTableAttachment extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('admin_attachment'))
        {
            Schema::create('admin_attachment', function (Blueprint $table) {
                $table->engine = 'InnoDB';

                $table->increments('ix');
                $table->integer('id')->unsigned();
                $table->string('lang_id', 2);
                $table->string('object_type');
                $table->integer('object_id')->unsigned();
                $table->integer('family_id')->unsigned()->nullable();
                $table->integer('sort')->unsigned()->nullable();
                $table->string('alt')->nullable();
                $table->string('title')->nullable();
                $table->string('base_path', 1024);
                $table->string('file_name');
                $table->string('url', 1024);                                // url to access file
                $table->string('mime');
                $table->string('extension');
                $table->integer('size')->unsigned();
                $table->smallInteger('width')->unsigned()->nullable();
                $table->smallInteger('height')->unsigned()->nullable();
                $table->integer('library_id')->unsigned()->nullable();             // original element in library
                $table->string('library_file_name')->nullable();
                $table->json('data')->nullable();

                $table->timestamps();
                $table->softDeletes();
                
                $table->foreign('lang_id', 'admin_attachment_lang_id_fk')
                    ->references('id')
                    ->on('admin_lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('family_id', 'admin_attachment_family_id_fk')
                    ->references('id')
                    ->on('admin_attachment_family')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('library_id', 'admin_attachment_library_id_fk')
                    ->references('id')
                    ->on('admin_attachment_library')
                    ->onDelete('set null')
                    ->onUpdate('cascade');

                $table->index(['id', 'lang_id'], 'admin_attachment_id_lang_id_idx');
                $table->index(['object_type', 'object_id'], 'admin_attachment_object_type_object_id_idx');
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
        Schema::dropIfExists('admin_attachment');
    }
}
