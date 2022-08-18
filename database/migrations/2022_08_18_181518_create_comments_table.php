<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId('article_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->text('body');

            $table
                ->foreignId('parent_id')
                ->nullable()
                ->constrained('comments')
                ->onDelete('cascade');

            $table->boolean('approved')->default(false);

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
        Schema::dropIfExists('comments');
    }
};
