<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Closure;

class SetLocale
{
    // public function handle(Request $request, Closure $next)
    // {
    //     $lang = app()->getLocale();

    //     if (!$lang){
    //         $lang = 'ru';
    //         app()->setLocale($lang);
    //     }

    //     if ($request->language){
    //         app()->setLocale($request->language == 'en' ? 'en' : 'ru');
    //         return redirect(\Request::getRequestUri());
    //     }

    //     if ($lang != $request->segment(1) && strlen($request->segment(1)) == '2'){
    //         if ($request->segment(1) == 'en'){
    //             return redirect(\Request::getRequestUri());
    //         }
    //     }

    //     // app()->setLocale($lang == 'en' ? $lang : 'ru');
 
    //     URL::defaults(['locale' => $request->segment(1)]);
 
    //     return $next($request);
    // }

    public function handle($request, Closure $next, $guard = null)
    {
        $locale = session()->get('language') ?? 'ru';
        $uri = $request->path();
        $uri_array = explode('/', $uri);
        $language = $uri_array[0];

        if ($request->language){
            session()->put('language', $request->language);
            
            return redirect(request()->path());
        }

        if ($locale != 'ru') {
            if ($language != $locale) 
                return redirect(asset('/' . $locale . '/' . $uri));
        } 
        else {
            if (in_array($language, config('app.available_locales'))) {
                array_shift($uri_array);
                return redirect(asset('/' . implode('/', $uri_array)));
            }
        }

        if (in_array($locale, config('app.available_locales')))
            app()->setLocale($locale);

    
        return $next($request);
    }


}