<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->integer('class_id')->default(3)->after('is_admin')->nullable()->index();
        });

        Schema::create('users_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::unprepared("UPDATE `users` SET `class_id` = '1' WHERE `is_admin` = '1'");

        DB::table('users_classes')->insert(
            [
                [
                    'id' => '1',
                    'name' => 'Администратор'
                ],
                [
                    'id' => '2',
                    'name' => 'Модератор'
                ],
                [
                    'id' => '3',
                    'name' => 'Обычный пользователь'
                ],
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
        Schema::dropIfExists('client_card');
        Schema::dropIfExists('client_type');
        Schema::dropIfExists('users_class');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('client_card');
            $table->dropColumn('client_type');
            $table->dropColumn('class');
        });
    }
};
