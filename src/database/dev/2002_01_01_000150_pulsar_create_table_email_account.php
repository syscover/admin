<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PulsarCreateTableEmailAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('email_account'))
        {
            Schema::create('email_account', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->string('email');
                $table->string('reply_to')->nullable();
                $table->string('outgoing_server');
                $table->string('outgoing_user');
                $table->string('outgoing_pass');
                $table->string('outgoing_secure', 5);                // null/TLS/SSL/SSLv2/SSLv3
                $table->smallInteger('outgoing_port');
                $table->string('incoming_type', 5);                  // pop, imap, mbox
                $table->string('incoming_server');
                $table->string('incoming_user');
                $table->string('incoming_pass');
                $table->string('incoming_secure', 5);                // null/SSL
                $table->smallInteger('incoming_port');
                $table->integer('n_emails')->unsigned();
                
                // field that records the last uid checked to see if there are more messages bounced check
                $table->integer('last_check_uid')->unsigned()->nullable();
                
                // uid that is cheking
                $table->integer('checking_uid')->unsigned()->nullable();
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
        Schema::dropIfExists('email_account');
    }
}