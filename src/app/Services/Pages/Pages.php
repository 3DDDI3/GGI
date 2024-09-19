<?php

namespace App\Services\Pages;

class Pages implements \App\Contracts\Pages
{
    public $model;
    public $request;

    public function __construct(
        \App\Models\Pages\Pages $model,
        \Request $request
    )
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function detect()
    {
       $path = $this->request::path();
       $path_array = explode('/', $path);
       $url = $path_array[0];
       $language_check = in_array($url, config('app.available_locales'));

       if (!$path || (sizeof($path_array) == 1 && $language_check))
           return $this->model::where('page_code', 'main')->first();
       else{
           if ($language_check){
             $url = explode('/', $path)[1];
           }
       }

       return $this->model::where('url', $url)->first();
    }

}
