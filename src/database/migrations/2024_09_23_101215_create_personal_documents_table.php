<?php

use App\Models\Pa\Acount;
use App\Models\Pa\PersonalDocumentType;
use App\Models\Pa\PersonalPage;
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
        Schema::create('personal_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Acount::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignIdFor(PersonalDocumentType::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignIdFor(PersonalPage::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->text("path")->nullable();
            $table->boolean("hide")
                ->nullable()
                ->default(0);
            $table->integer("rating")
                ->nullable()
                ->default(0);
            $table->text("comment")->nullable();
            $table->year("year")->nullable();
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
        Schema::dropIfExists('personal_documents');
    }
};
