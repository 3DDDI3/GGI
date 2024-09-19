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
    Schema::create('council', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->text('text')->nullable();
      $table->integer('rating')->nullable();
      $table->tinyInteger('hide')->default(0);
      $table->timestamps();
    });

    $array[] = ['name' => 'Диссертационный совет', 'url' => 'dissertacionnyi-sovet', 'page_code' => 'dissertacionnyi-sovet'];
    DB::table('pages')->insert($array);

  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('council');
  }
};