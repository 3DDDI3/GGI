<?php

use App\Models\Pages\Pages;
use Illuminate\Support\Facades\DB;
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
        $arr = [       
            Pages::where('page_code', 'institute')->first()->id => [
                ['name' => 'Филиалы'],
                ['name' => 'История'],
                ['name' => 'Администрация'],
                ['name' => 'Структура'],
                ['name' => 'Сотрудники'],
                ['name' => 'Архив новостей'],
                ['name' => 'Документы'],
                ['name' => 'Единый фонд данных'],
                ['name' => 'Противодействия коррупции'],
                ['name' => 'Госзакупки'],
                ['name' => 'Страница памяти'],
                ['name' => 'Фирменный стиль'],
                ['name' => 'Вакансии']
            ],
            Pages::where('page_code', 'science')->first()->id => [
                ['name' => 'Сведения об образовательной организация'],
                ['name' => 'Ученый совет'],
                ['name' => 'Диссертационный совет'],
                ['name' => 'Международное сотрудничество'],
                ['name' => 'Интеллектуальная собственность'],
                ['name' => 'Журнал "Гидрологический вестник"'],
                ['name' => 'ГИСы'],
                ['name' => 'Издания'],
                ['name' => 'Публикации']
            ],
            Pages::where('page_code', 'services')->first()->id => [
                ['name' => 'Выполнение научно - исследовательских работ'],
                ['name' => 'Выполнение инженерно - гидрологических изысканий'],
                ['name' => 'Выполнение работ специального и регионального назначения в области гидрометеорологии'],
                ['name' => 'Экспертные услуги в области гидрологии'],
                ['name' => 'Интеллектуальная собственность'],
                ['name' => 'Поверка, калибровка и сертификация приборов и оборудования гидрологического назначения'],
                ['name' => 'Консультационные услуги'],
                ['name' => 'Образовательные услуги'],
                ['name' => 'Международная деятельность']
            ],
            Pages::where('page_code', 'education')->first()->id => [
                ['name' => 'Аспирантура'],
                ['name' => 'Курсы повышения квалификации']
            ]
        ];

        $arr2 = [];

        foreach ($arr as $key => $value){
            foreach ($value as &$value2){
                $value2['parent_id'] = $key;
                $value2['page_code'] = str_slug($value2['name']);
                $value2['url'] = str_slug($value2['name']);
                $arr2[] = $value2;
            }
        }



        DB::table('pages')->insert($arr2);
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
