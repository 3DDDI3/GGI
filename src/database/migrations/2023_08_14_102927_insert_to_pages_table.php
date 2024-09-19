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
        $array = [       
            [
                'name' => 'Институт', 
                'page_code' => 'institute',
                'url' => 'institute',
                'header_hide' => 0,
                'footer_hide' => 0
            ],
            [
                'name' => 'Наука',
                'page_code' => 'science',
                'url' => 'science',
                'header_hide' => 0,
                'footer_hide' => 0
            ],
            [
                'name' => 'Услуги',
                'page_code' => 'services',
                'url' => 'services',
                'header_hide' => 0,
                'footer_hide' => 0
            ],
            [
                'name' => 'Образование',
                'page_code' => 'education',
                'url' => 'education',
                'header_hide' => 0,
                'footer_hide' => 0
            ],
            [
                'name' => 'Контакты',
                'page_code' => 'contacts',
                'url' => 'contacts',
                'header_hide' => 0,
                'footer_hide' => 0
            ],
            [
                'name' => 'Новости',
                'page_code' => 'news',
                'url' => 'news',
                'header_hide' => 1,
                'footer_hide' => 1
            ]          
        ];



        DB::table('pages')->insert($array);
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
