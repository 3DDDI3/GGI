<?php

use App\Models\Pa\AcountType;
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
        Schema::create('acounts', function (Blueprint $table) {
            $table->id();
            $table->string('lastName', 255)->nullable();
            $table->string('firstName', 255)->nullable();
            $table->string('secondName', 255)->nullable();
            $table->foreignIdFor(AcountType::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('email', 500)->nullable();
            $table->string('password', 255)->nullable();
            $table->timestamp('birthday')->nullable();
            $table->string('specialty', 1000)->nullable();
            $table->string('study_place', 1000)->nullable();
            $table->text('icon')->nullable();
            $table->text('passport')->nullable();
            $table->text('inn')->nullable();
            $table->text('snils')->nullable();
            $table->boolean('isConfirmed')->nullable()->default(0);
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
        Schema::dropIfExists('acounts');
    }
};
