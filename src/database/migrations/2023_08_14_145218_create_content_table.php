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
            $table->tinyInteger('hide')->default(0);
            $table->integer('rating')->nullable();
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->string('text')->nullable();
            $table->string('text_en')->nullable();
            $table->text('link')->nullable();
            $table->string('type')->nullable();
            $table->string('model')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('item_id')->default(0);
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
        Schema::dropIfExists('content');
    }
};
