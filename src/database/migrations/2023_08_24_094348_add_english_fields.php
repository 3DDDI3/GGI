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
        Schema::table('staff', function (Blueprint $table) {
            $table->string('position_en')->nullable();
            $table->string('degree_en')->nullable();
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('description_en')->nullable();
            $table->string('text_en')->nullable();
        });

        Schema::table('council', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('text_en')->nullable();
        });

        Schema::table('eform', function (Blueprint $table) {
            $table->string('name1_en')->nullable();
            $table->string('name2_en')->nullable();
            $table->string('name3_en')->nullable();
            $table->string('organization_en')->nullable();
            $table->string('position_en')->nullable();
            $table->string('text_en')->nullable();
        });

        Schema::table('institute_objects', function (Blueprint $table) {
            $table->string('text_en')->nullable();
        });

        Schema::table('laboratories', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('text_en')->nullable();
        });

        Schema::table('portfolio', function (Blueprint $table) {
            $table->string('customer_en')->nullable();
        });

        Schema::table('publications', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->string('text_en')->nullable();
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->string('name_en')->nullable();;
            $table->string('text_en')->nullable();

        });

        Schema::table('subdivisions', function (Blueprint $table) {
            $table->string('name_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
