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
        Schema::create('article_titles', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->foreignId("category_id")->constrained();
            $table->foreignId("article_id")->nullable()->constrained();

            $table->boolean("status")->default(true);

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
        Schema::dropIfExists('article_titles');
    }
};
