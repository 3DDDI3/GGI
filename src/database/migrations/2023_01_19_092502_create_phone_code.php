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
        Schema::create('phone_code', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rating')->default(0)->nullable();
            $table->timestamps();
        });

        DB::table('phone_code')->insert(
            [
                [ 'name' => '+7' ],
                [ 'name' => '+375' ],
                [ 'name' => '+374' ],
                [ 'name' => '+996' ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone_code');
    }
};
