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
        'passport_comment',
        'inn',
        'inn_comment',
        'snils',
        'snils_comment',
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
     * @param string $type Тип документа
     * @param integer $user_id Id пользователя
     * @param integer|null $year - год
     * @return Collection
     */
    public function certainDocument(string $type, int $user_id, int $year = null): Collection
    {
        if (!empty($year))
            $result = $this->documents()
                ->where([
                    'acount_id' => $user_id,
                    'personal_document_type_id' => PersonalDocumentType::query()
                        ->where(['type' => $type])
                        ->first()->id,
                    'year' => $year
                ])->get();

        $result = $this->documents()
            ->where([
                'acount_id' => $user_id,
                'personal_document_type_id' => PersonalDocumentType::query()
                    ->where(['type' => $type])
                    ->first()->id
            ])->get();

        return $result;
    }
}
