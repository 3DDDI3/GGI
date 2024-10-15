<?php

namespace App\Providers;

use App\Models\Content;
use App\Models\SEO;
use App\Models\Setting;
use App\Services\Pages\Pages;
use App\View\Components\Admin\Controls\InputFile;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {



        Schema::defaultStringLength(191);

        if (\App::runningInConsole()) return; //чтобы не было проблем с миграциями

        $this->app->bind(\App\Contracts\Pages::class, fn() => new Pages(
            new \App\Models\Pages\Pages(),
            new \Request()
        ));

        if (Request::ajax()) return;

        $setting = Setting::find(1);
        $pages_header =  \App\Models\Pages\Pages::getList(true, false, true);
        $pages_footer = \App\Models\Pages\Pages::getList(false, true, true);
        $services = Content::getServicesList();

        $seoPage = SEO::where('url', Request::path())->first();
        $seoPage = $seoPage ?? SEO::where('url', '*')->first();

        $url = explode('/', Request::path())[0];
        $page = \App\Models\Pages\Pages::where('url', $url)->first();


        $seo = new \App\Services\SEO\SEO(
            $seoPage,
            $page,
            new SEOMeta(),
            new OpenGraph(),
            new TwitterCard(),
            new JsonLd()
        );
        $seo->buildSets();

        Blade::anonymousComponentNamespace('input-file', InputFile::class);
        View::composer('includes.head', fn($view) => $view->with(['seo' => $seo]));
        View::composer('includes.header', fn($view) => $view->with(['pages' => $pages_header, 'services' => $services]));
        View::composer('includes.footer', fn($view) => $view->with(['pages' => $pages_footer, 'services' => $services]));
        View::composer('*', fn($view) => $view->with(['setting' => $setting]));
    }
}
