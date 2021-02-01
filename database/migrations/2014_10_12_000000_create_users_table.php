<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->boolean('notification_email_unassigned_tickets')->default(false);
            $table->boolean('notification_email_assigned_tickets')->default(false);
            $table->boolean('notification_email_replies')->default(false);
            $table->boolean('notification_email_messages')->default(false);
            $table->string('push_notifications')->default('push_nothing');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar')->default('/images/users/avatar-default.png');
            $table->string('password');
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->unsignedBigInteger('company_id');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
