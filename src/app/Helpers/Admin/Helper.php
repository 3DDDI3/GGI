<?php

namespace App\Helpers\Admin;

use App\Models\User\AdminAccessRights;
use App\Models\User\UserСlass;
use App\Models\User\UserСlasses;
use Illuminate\Http\Request;

class Helper
{
    public static function multiple($value) {
        if (empty($value)) return;

        if (in_array('0', $value)) return null;

        $value = '|'.implode('|', $value ?? array()).'|';

        return $value;
    }

    public static function multiple_info($MODEL, $value) {

        if (empty($value)) return 'Все';

        $value = trim($value, '|');
        $arr = explode('|', $value);

        if (empty($arr)) return 'Все';

        $names = '';
        $result = array();
        $items = $MODEL::whereIn('id', $arr)->get();
        if ($items) {
            $value = '';
            foreach ($items as $item) {
                $result[] = $item->name ?? '';
            }
        }
        $names = implode(', ', $result);

        return $names;
    }

    public static function multiple_filter($objects, $field, $select, $request) {

        if (empty($objects) || empty($field) || empty($select)) return $objects;

        $search_select = (int)$request->{$select} ?? 0;
        if(!empty($search_select)) {
            $objects->where(function($query) use($search_select, $field) {
                $query->where($field, 'LIKE', "%|".$search_select."|%")
                ->orWhereNull($field)
                ->orWhere($field, '0');
            });
        }

        return $objects;
    }

    public static function select_filter($objects, $field, $select, $request) {

        if (empty($objects) || empty($field) || empty($select)) return $objects;

        $search_select = (int)$request->{$select} ?? 0;
        if(!empty($search_select)) {
            $objects->where($field, $search_select);
        }

        return $objects;
    }

    public static function object_name($MODEL, $value) {
        if (empty($value)) return;

        $name = '';
        $object = $MODEL::where('id', $value)->first();
        if ($object) {
            $name = $object->name ?? '';
        }

        return $name;
    }

    public static function url_uniq($model, $object) {
        if (empty($object) || empty($model)) return;

        $url = $object->url ?? '';
        $id = $object->id ?? '';
        if (empty($url) || empty($id)) return;

        $item = $model::where('url', $url)
            ->where('id', '<>', $id)
            ->first();
        if ($item) {
            $object->url = $url.'-'.$id;
            $object->save();
        }
    }

    public static function search($objects, $search, $fields = array()) {

        if (empty($search) || empty($fields)) return $objects;

        $objects->where(function($query) use ($search, $fields) {
            foreach ($fields AS $field) {
                $query->orWhere($field, 'LIKE', "%".str_replace(' ' , '%' , $search)."%");
            }
        });

        return $objects;
    }

    public static function card_format($val) {
        if (empty($val)) return;
        $val = preg_replace('/\d{4}/', "$0 ", $val);
        return $val;
    }

    public static function hash() {
		$hash = md5(uniqid(rand(), true));
		return $hash;
	}

    public static function date_save($date, $type = 'start') {
        if (empty($date)) return;
		$date = strtotime($date);
        $date = date('d.m.Y', $date);
        if ($type == 'start') $date .= ' 00:00';
        else $date .= ' 23:59';
        $date = strtotime($date);
        return $date;
	}

    public static function date_view($date) {
        if (empty($date)) return;
		$date = date('Y-m-d', $date);
        return $date;
	}

    public static function getAdminPathByUrl($url)
    {
        $path = app('router')->getRoutes()->match(app('request')->create($url))->getName();
        $path = str_replace('admin.', '', $path);
        $path = str_replace('.index', '', $path);
        $path = str_replace('.edit', '', $path);

        return $path;
    }

    public static function getAdminSectionRights($path, UserСlasses $object)
    {
        $result = [];
        if ($object && $object->rights())
            if ($rights=$object->rights()->where('path', $path)->get())
                foreach ($rights as $right)
                    $result[]=$right->type;
        return $result;
    }

    public static function getAdminSections(UserСlasses $object=null, $without_departments=false)
    {
        require_once(public_path().'/lib/simple_html_dom.php');

        $result = [];
        $view = view('admin.links', ['all' => true])->render();
        $view = '<div class="dom">'.$view.'</div>';
        $dom = str_get_html($view);

        $nav_groups = $dom->find('.admin_nav_group');
        foreach ($nav_groups as $nav_group){
            if (!$without_departments) {
                $key = $nav_group->attr['data-url'];
                $result[$key]['name'] = $nav_group->find('.admin_nav_title', 0)->innertext;
                $result[$key]['children'] = [];
            }
            $children = $nav_group->find('a');

            foreach ($children as $child){
                $path = self::getAdminPathByUrl($child->attr['href']);
                if ($without_departments)
                    $result[$path]['name'] = trim($child->innertext);
                else
                    $result[$key]['children'][$path]['name'] = trim($child->innertext);

                if ($object) $result[$key]['children'][$path]['rights'] = self::getAdminSectionRights($path, $object);
            }
        }

        $top_links = $dom->find('.dom > a');
        foreach ($top_links as $top_link){
            $path = self::getAdminPathByUrl($top_link->attr['href']);
            $result[$path]['name'] = trim($top_link->innertext);
            if ($object) $result[$path]['rights'] = self::getAdminSectionRights($path, $object);
        }

        return $result;
    }

    public static function getSectionNameByPath($path)
    {
        return self::getAdminSections(null, true)[$path]['name'];
    }

    public static function checkRights($url, $type)
    {
        $path = self::getAdminPathByUrl($url);
        $rights = auth()
                ->user()
                ->user_class
                ->rights()
                ->where('path', $path)
                ->where('type', $type)
                ->get();
        return (!$rights->isEmpty());
    }
}
