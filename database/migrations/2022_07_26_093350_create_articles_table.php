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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->string("slug")->unique();
            $table->text("summary");
            $table->longText("description");
            $table->string("image")->nullable();

            $table->foreignId("category_id")->constrained();

            $table->foreignId("writer_id")->constrained("users");
            $table->foreignId("editor_id")->constrained("users");

            $table->dateTime("published_at")->nullable();
            $table->boolean("status")->default(true);

            $table->json("tables")->nullable();

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
        Schema::dropIfExists('articles');
    }
};
