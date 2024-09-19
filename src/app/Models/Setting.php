<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'setting';

    public $timestamps = false;

    public $fillable = [
        'phone',
        'email',
        'address',
        'link1',
        'link2',
        'main_info_title',
        'main_info_quote',
        'main_info_text',
        'main_info_title_en',
        'main_info_quote_en',
        'main_info_text_en',
        'director_reception_phone',
        'director_reception_email',
        'contact_page_address',
        'contact_page_address_en',
        'section_1_text_1',
        'section_1_text_2',
        'section_1_text_3',
        'section_1_text_4',
        'section_1_text_5',
        'section_2_text_1',
        'section_2_text_2',
        'section_2_text_3',
        'section_2_text_4',
        'section_2_text_5',
        'section_2_text_6',
        'section_3_text_1',
        'section_5_text_1',
        'section_5_text_2',
        'section_5_text_3',
        'section_6_text_1'
    ];


}
