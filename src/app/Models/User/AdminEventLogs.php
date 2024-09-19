<?php

namespace App\Models\User;

use App\Helpers\Admin\Helper;
use Illuminate\Database\Eloquent\Model;

class AdminEventLogs extends Model
{
    protected $table = 'admin_event_logs';

    public $fillable =  [
        'action',
        'section',
        'user_id',
        'item_id',
        'item_model'
    ];

    public $actions = [
        'create' => 'Создание',
        'update' => 'Обновление',
        'delete' => 'Удаление'
    ];

    public static function log($object, $id=null)
    {
        $log = new self();

        if ($object === false)
            $log->action = 'delete';
        else
            $log->action = $id ? 'update' : 'create';

        $log->path = Helper::getAdminPathByUrl(\Request::url());
        $log->user_id = auth()->user()->id;
        $log->item_model = $object ? get_class($object) : null;
        $log->item_id = $id ?? $object->id;

        $log->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getList($count)
    {
        $objects = self::orderBy('id', 'desc')->paginate($count);
        foreach ($objects as &$object) {
            if ($object->item_model)
                $object->item = $object->item_model::find($object->item_id);
            
        }

        return $objects;
    }

}
