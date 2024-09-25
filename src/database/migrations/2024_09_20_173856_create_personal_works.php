<?php

use App\Models\Pa\Acount;
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
        Schema::create('personal_works', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Acount::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->year('year')->nullable();
            $table->string('topic')->nullable();
            $table->string('scientific_head')->nullable()->comment('Научный руководитель');
            $table->string('post')->comment('Должность')->nullable();
            $table->string('scientific_degree')->comment('Научная степень')->nullable();
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
        Schema::dropIfExists('personal_works');
    }
};
