<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCreateTableAttachmentFamily extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('admin_attachment_family'))
        {
            Schema::create('admin_attachment_family', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->increments('id');
                $table->string('resource_id', 30); // resource which belong to this attachment
                $table->string('name');
                $table->smallInteger('width')->unsigned()->nullable();
                $table->smallInteger('height')->unsigned()->nullable();
                $table->tinyInteger('fit_type')->unsigned()->default(1); // 1 = crop, 2 = width, 3 = height, 4 = width free crop, 5 = height free crop
                $table->json('sizes')->nullable();
                $table->tinyInteger('quality')->unsigned()->default(90);
                $table->string('format', 10)->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('resource_id', 'fk01_admin_attachment_family')
                    ->references('id')
                    ->on('admin_resource')
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
        Schema::dropIfExists('admin_attachment_family');
    }
}
