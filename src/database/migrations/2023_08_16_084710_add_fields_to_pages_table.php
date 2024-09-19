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
        Schema::table('pages', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->text('text_en')->nullable()->after('text');
            $table->text('text_2')->nullable();
            $table->text('text_2_en')->nullable();
            $table->text('text_3')->nullable();
            $table->text('text_3_en')->nullable();
            $table->text('text_4')->nullable();
            $table->text('text_4_en')->nullable();
            $table->text('text_5')->nullable();
            $table->text('text_5_en')->nullable();
            $table->text('text_6')->nullable();
            $table->text('text_6_en')->nullable();
            $table->text('text_7')->nullable();
            $table->text('text_7_en')->nullable();
            $table->text('text_8')->nullable();
            $table->text('text_8_en')->nullable();
            $table->text('text_9')->nullable();
            $table->text('text_9_en')->nullable();
            $table->text('text_10')->nullable();
            $table->text('text_10_en')->nullable();
            $table->text('text_11')->nullable();
            $table->text('text_11_en')->nullable();
            $table->text('text_12')->nullable();
            $table->text('text_12_en')->nullable();
            $table->text('text_13')->nullable();
            $table->text('text_13_en')->nullable();
            $table->text('text_14')->nullable();
            $table->text('text_14_en')->nullable();
            $table->text('text_15')->nullable();
            $table->text('text_15_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            //
        });
    }
};
