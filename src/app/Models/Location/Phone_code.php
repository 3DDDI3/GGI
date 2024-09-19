<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

class Phone_code extends Model
{
    protected $table = 'phone_code';

    public $fillable = [
        'name',
        'rating',
    ];

    public static function list(){
        $list = self::orderBy('rating', 'desc')
            ->orderBy('id', 'asc')
            ->get();
        return $list;
    }

    public static function check($object){
        $phone = $object->phone ?? '';
        if (empty($phone)) return $object;
        $self = self::all();
        foreach ($self AS $item) {
            $code = $item->name ?? '';
            $phone_clear = str_replace($code.' '.$code, $code, $phone);
            if ($phone_clear <> $phone && !empty($phone_clear)) {
                $object->phone = $phone_clear;
                $object->save();
            }
        }
        return $object;
    }
}
