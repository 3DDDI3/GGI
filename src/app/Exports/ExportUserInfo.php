<?php

namespace App\Exports;

use App\Models\Pa\Acount;
use App\Models\Pa\AcountType;
use App\Models\Pa\PersonalWork;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ExportUserInfo implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnWidths
{
    private $id;
    private $acount_type;

    public function __construct($id, $acount_type)
    {
        $this->id = $id;
        $this->acount_type = $acount_type;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $acount = Acount::query()
            ->where(['id' => $this->id])
            ->get([
                'lastName',
                'firstName',
                'secondName',
                'admission_year',
                'email',
                'birthday',
                'study_place',
                'specialty',
                'acount_type_id'
            ]);

        if ($acount->first()->acount_type_id == 1) {
            /**
             * Абитуриент
             */

            $personalWork = PersonalWork::query()
                ->where(['acount_id' => $this->id])
                ->first(['year', 'topic', 'scientific_head', 'scientific_degree', 'post']);

            if ($personalWork) {
                $year = empty($personalWork->year) ? "" : "{$personalWork->year} г.";
                $separate = !empty($personalWork->post) && !empty($personalWork->scientific_degree) ? "," : "";

                $acount->first()->scientific_head = "{$personalWork->scientific_head} ({$personalWork->post}{$separate}{$personalWork->scientific_degree})";
                $acount->first()->scientific_work = "{$personalWork->topic}{$year}";
            }
        }

        $acount->first()->acount_type_id = $acount->first()->acountType->type;
        return $acount;
    }

    public function headings(): array
    {
        if ($this->acount_type == 1)
            return [
                'Фамилия',
                'Имя',
                'Отчество',
                'Дата поступления',
                'Email',
                'Дата рождения',
                'Место обучения',
                'Специальнось',
                'Тип пользователя',
                'Научный руководитель',
                'Научная работа'
            ];
        else
            return [
                'Фамилия',
                'Имя',
                'Отчество',
                'Дата поступления',
                'Email',
                'Дата рождения',
                'Место обучения',
                'Специальнось',
                'Тип пользователя',
            ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
            'J' => 30,
            'K' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A1' => ['font' => ['bold' => true, 'size' => 14]],
            'B1' => ['font' => ['bold' => true, 'size' => 14]],
            'C1' => ['font' => ['bold' => true, 'size' => 14]],
            'D1' => ['font' => ['bold' => true, 'size' => 14]],
            'E1' => ['font' => ['bold' => true, 'size' => 14]],
            'F1' => ['font' => ['bold' => true, 'size' => 14]],
            'G1' => ['font' => ['bold' => true, 'size' => 14]],
            'H1' => ['font' => ['bold' => true, 'size' => 14]],
            'I1' => ['font' => ['bold' => true, 'size' => 14]],
            'J1' => ['font' => ['bold' => true, 'size' => 14]],
            'K1' => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }
}
