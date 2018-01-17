<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_notification', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('detail');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location');
            $table->string('address1');
            $table->string('address2');
            $table->string('city');
            $table->string('state');
            $table->integer('zip');
            $table->string('lat');
            $table->string('lng');
            $table->string('place_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->string('media_type');
            $table->string('title');
            $table->string('format');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('admin_password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->timestamps('failed_at');
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedTinyInteger('reserved')->index();
            $table->unsignedInteger('reserved_at')->index();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('log', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message');
            $table->string('code');
            $table->text('file');
            $table->integer('line');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('mobile');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('mobile');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('configuration', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_notification');
        Schema::dropIfExists('address');
        Schema::dropIfExists('media');
        Schema::dropIfExists('admin_password_resets');
        Schema::dropIfExists('configuration');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('log');
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('users');
    }
}
