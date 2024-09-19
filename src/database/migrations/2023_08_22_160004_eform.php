<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {


    Schema::create('eform', function (Blueprint $table) {
      $table->id();
      $table->string('name1')->nullable();
      $table->string('name2')->nullable();
      $table->string('name3')->nullable();
      $table->string('email')->nullable();
      $table->string('organisation')->nullable();
      $table->string('position')->nullable();

      $table->string('zipcode')->nullable();
      $table->string('region')->nullable();
      $table->string('city')->nullable();
      $table->string('address')->nullable();
      $table->text('text')->nullable();


      $table->integer('rating')->nullable();

      $table->timestamps();
  });



    $array[] = ['name' => "Электронная форма обращений", 'url' => 'eform', 'page_code' => 'eform'];
    DB::table('pages')->insert($array);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('eform');
  }
};