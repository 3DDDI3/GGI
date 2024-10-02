<?php

namespace App\Models\Pa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PersonalDocument extends Model
{
    use HasFactory;

    public function document(): HasOne
    {
        return $this->hasOne(PersonalDocumentType::class, 'id', 'personal_document_type_id');
    }

    public function page(): HasOne
    {
        return $this->hasOne(PersonalPage::class, 'id', 'personal_page_id');
    }

    public function agent(): HasOne
    {
        return $this->hasOne(Acount::class, 'id', 'acount_id');
    }

    protected $table = "personal_documents";

    protected $fillable = [
        'acount_id',
        'personal_document_type_id',
        'personal_page_id',
        'path',
        'year',
        'comment',
    ];
}
