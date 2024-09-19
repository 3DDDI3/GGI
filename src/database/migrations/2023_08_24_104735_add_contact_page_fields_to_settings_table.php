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
        Schema::table('setting', function (Blueprint $table) {
            $table->string("director_reception_phone")->nullable();
            $table->string("director_reception_email")->nullable();
            $table->string("contact_page_address")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting', function (Blueprint $table) {
            $table->dropColumn("director_reception_phone");
            $table->dropColumn("director_reception_email");
            $table->dropColumn("contact_page_address");
        });
    }
};
