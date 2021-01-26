<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboundEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbound_emails', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->json('attachments')->nullable();
            $table->unsignedBigInteger('receivable_id')->nullable();
            $table->string('receivable_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inbound_emails');
    }
}
