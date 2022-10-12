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
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->string('page', 255);
            $table->text('page_text');
            $table->string('title', 255);
            $table->string('title_seo', 255)->nullable();
            $table->string('description', 255)->nullable();
//            $table->timestamp('created_at')->nullable();
//            $table->timestamp('updated_at')->nullable();
            $table->integer('last_mod')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content');
    }
};
