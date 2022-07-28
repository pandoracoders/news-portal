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
        Schema::table('users', function (Blueprint $table) {
            $table->string("alias_name");
            $table->string("slug")->unique();
            $table->string("avatar")->nullable();
            $table->string("gender")->nullable();
            $table->boolean("status")->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("alias_name");
            $table->dropColumn("slug");
            $table->dropColumn("avatar");
            $table->dropColumn("gender");
            $table->dropColumn("status");
        });
    }
};
