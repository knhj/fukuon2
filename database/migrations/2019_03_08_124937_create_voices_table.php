<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voices', function (Blueprint $table) {
          
            $table->increments('id');
            $table->string('name')->default('No name');
            $table->string('user_id')->nullable();
            $table->string('video_id');
            $table->string('fukuon_id');
            $table->string('fukuon_title')->default('No title');
            $table->text('fukuon_comment')->nullable();
            $table->integer('play_count')->default(0);
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
        Schema::dropIfExists('voices');
    }
}
