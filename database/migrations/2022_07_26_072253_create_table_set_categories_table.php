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
        Schema::create('table_set_categories', function (Blueprint $table) {
            $table->id();

            $table->foreignId("category_id")->constrained("categories");
            $table->foreignId("table_set_id")->constrained("table_sets");

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
        Schema::table("table_set_categories", function (Blueprint $table) {
            $table->dropForeign(["category_id"]);
            $table->dropForeign(["table_set_id"]);
        });
        Schema::dropIfExists('table_set_categories');
    }
};
