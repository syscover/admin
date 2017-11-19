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
                
                $table->integer('id');
                $table->string('lang_id', 2);
                $table->integer('object_id')->unsigned()->nullable();
                $table->string('object_type');
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
                
                $table->foreign('lang_id', 'fk01_admin_attachment')
                    ->references('id')
                    ->on('admin_lang')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('family_id', 'fk02_admin_attachment')
                    ->references('id')
                    ->on('admin_attachment_family')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                $table->foreign('library_id', 'fk03_admin_attachment')
                    ->references('id')
                    ->on('admin_attachment_library')
                    ->onDelete('set null')
                    ->onUpdate('cascade');

                $table->index(['object_id'], 'ix01_admin_attachment');
                $table->index(['object_type'], 'ix02_admin_attachment');
                $table->primary(['id', 'lang_id'], 'pk01_admin_attachment');
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
