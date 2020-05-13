<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socket_apps', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string("name");

            $table->string("key");
            $table->unique("key");

            $table->string("secret");
            $table->unique("secret");

            $table->boolean("enable_client_messages")->default(false);
            $table->boolean("enable_statistics")->default(true);

            $table->bigInteger("user_id")->unsigned();
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socket_apps');
    }
}
