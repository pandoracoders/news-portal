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
            $table->text("summary")->nullable();
            $table->longText("body")->nullable();
            $table->string("image")->nullable();

            $table->foreignId("category_id")->constrained();

            $table->foreignId("writer_id")->nullable()->constrained("users");
            $table->foreignId("editor_id")->nullable()->constrained("users");

            $table->dateTime("published_at")->nullable();
            $table->boolean("status")->default(true);

            $table->boolean("is_featured")->default(false);

            $table->string("task_status")->default("writting");

            $table->boolean(("editor_choice"))->default(false);

            $table->integer("views")->default(0);

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
