<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->string('subject');
            $table->string('status')->default('new');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->boolean('inbound')->default(true);
            $table->boolean('private')->default(false);
            $table->boolean('more')->default(false);
            $table->json('attachments')->nullable();
            $table->timestamp('read_at')->nullable();

            // Computed fields
            $table->string('userInitials')->nullable();
            $table->string('companyName')->nullable();
            $table->string('companyInitials')->nullable();
            $table->string('organizationName')->nullable();
            $table->unsignedInteger('unreadCount')->default(0);

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
        Schema::dropIfExists('tickets');
    }
}
