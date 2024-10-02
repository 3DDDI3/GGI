<?php

namespace App\Models\Pa;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Acount extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = "acounts";

    protected $fillable = [
        'lastName',
        'firstName',
        'secondName',
        'email',
        'password',
        'birthday',
        'specialty',
        'study_place',
        'icon',
        'passport',
        'inn',
        'snils',
    ];

    protected $casts = [
        'birthday' => 'datetime:H:i d.m.Y',
    ];

    public function acountType(): HasOne
    {
        return $this->hasOne(AcountType::class, 'id', 'acount_type_id');
    }

    public function documents()
    {
        return $this->hasMany(PersonalDocument::class);
    }

    public function works(): HasMany
    {
        return $this->hasMany(PersonalWork::class);
    }

    /**
     * Получение определенного документа
     *
     * @param string $type название типа документа
     * @return PersonalDocument
     */
    public function certainDocument(string $type, int $year = null): PersonalDocument
    {
        if (!empty($year))
            $result = $this->documents()
                ->where([
                    'personal_document_type_id' => PersonalDocumentType::query()
                        ->where(['type' => $type])
                        ->first()->id,
                    'year' => $year
                ])->first();

        $result = $this->documents()
            ->where([
                'personal_document_type_id' => PersonalDocumentType::query()
                    ->where(['type' => $type])
                    ->first()->id
            ])->first();

        return !$result ? new PersonalDocument() : $result;
    }
}
