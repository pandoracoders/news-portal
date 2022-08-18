<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_logs', function (Blueprint $table) {

            $table->id();

            $table->foreignId("article_id")->constrained();
            $table->foreignId("actor")->constrained("users");
            $table->string("action");
            $table->string("task_status");
            $table->dateTime("log_at");
            $table->json("article");
            $table->text("discussion")->nullable();


            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_logs');
    }
};
