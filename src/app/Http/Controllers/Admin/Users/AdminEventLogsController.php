<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User\AdminEventLogs;
use Illuminate\Http\Request;

class AdminEventLogsController extends Controller
{
    public $PATH = 'users.admin_event_logs';
    public $TITLE = ['Журнал событий', 'лог'];
    public $MODEL = AdminEventLogs::class;

    public function index(Request $request)
    {
        $path = $this->PATH;
        $title = $this->TITLE;
        $full_width = true;

        $objects = $this->MODEL::getList(50);

        return view('admin.modules.' . $path . '.index', compact('objects', 'path', 'title', 'full_width'));
    }

}
