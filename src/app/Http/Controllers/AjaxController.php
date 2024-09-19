<?php

namespace App\Http\Controllers;

use App\Helpers\Search;
use App\Models\Branches;
use App\Models\InstituteObjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AjaxController extends Controller
{
    public function index($method, Request $request) {
        switch ($method) {
            case 'get-institute-object':

                $objects = InstituteObjects::getList();
                $array = [];

                foreach ($objects as $object) {
                    $coordinates = preg_replace('/[^0-9.,]/', '', $object->coordinates);
                    if ($coordinates) {
                        $coordinates_array = explode(',', $coordinates);
                        if (isset($coordinates_array[0]) && isset($coordinates_array[1])) {
                            $array[] = [
                                'coordinates_x' => $coordinates_array[0],
                                'coordinates_y' => $coordinates_array[1],
                                'text' => $object->{__('text')},
                                'location' => $object->{__('location')},
                                'title' => $object->{__('title')},
                                
                            ];
                        }
                    }
                }

                echo json_encode($array);
                break;
            case 'search':
                $query = $request->input('query');

                echo Search::search_results($query);
                break;
        }
    }
}
