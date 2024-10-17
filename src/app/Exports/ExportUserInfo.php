<?php

namespace App\Exports;

use App\Models\Pa\Acount;
use App\Models\Pa\AcountType;
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
            ]);

        $acount->first()->type = "asd";

        // $acount->first()->type = AcountType::query()
        //     ->where(['id' => $this->acount_type])
        //     ->first()
        //     ->type;


        dd($acount);

        return $acount;
    }

    public function headings(): array
    {
        return [
            'Фамилия',
            'Имя',
            'Отчество',
            'Дата поступления',
            'Email',
            'Дата рождения',
            'Место обучения',
            'Научный руководитель',
            'Тип пользователя'
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
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            'A1' => ['font' => ['bold' => true, 'size' => 14]],

            // Styling a specific cell by coordinate.
            'B1' => ['font' => ['bold' => true, 'size' => 14]],

            // Styling an entire column.
            'C1'  => ['font' => ['bold' => true, 'size' => 14]],

            'D1'  => ['font' => ['bold' => true, 'size' => 14]],

            'E1'  => ['font' => ['bold' => true, 'size' => 14]],

            'F1'  => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }
}
