<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    public $fillable = [
        'hide',
        'name',
        'name_en',
        'position',
        'position_en',
        'degree',
        'degree_en',
        'phone',
        'description',
        'email',
        'laboratories_id',
        'subdivisions_id',
        'rating'
    ];


    public static function getList($subdivisions_id=null, $laboratories_id=null)
    {
        $query = self::query()
        ->where('hide', 0);

        if ($subdivisions_id)
            $query->where('subdivisions_id', $subdivisions_id);

        if ($laboratories_id)
            $query->where('laboratories_id', $laboratories_id);

        return $query->orderBy('rating', 'desc')
        ->orderBy('id', 'desc')
        ->get();
    }

    public function subdivision()
    {
        return $this->belongsTo(Subdivisions::class, 'subdivisions_id');
    }
    
    public function laboratory()
    {
        return $this->belongsTo(Laboratories::class, 'laboratories_id');
    }

}
