<?php

namespace Penmedia\Common;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class PenmediaCommonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        |--------------------------------------------------------------------------
        | Load the language translation
        |--------------------------------------------------------------------------
        */
        $this->loadTranslationsFrom( __DIR__ . '/resources/lang', 'penmedia\common' );

        /*
        |--------------------------------------------------------------------------
        | Load the Views
        |--------------------------------------------------------------------------
        */
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'common');
        $this->publishes([
            __DIR__ . '/resources/views' => base_path('resources/views')
        ]);

        /*
        |--------------------------------------------------------------------------
        | Load the helper file
        |--------------------------------------------------------------------------
        */
        if (file_exists($file = $this->app->basePath().'/packages/penmedia/common/Http/PenmediaHelpers.php'))
        {
            require $file;
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require __DIR__.'/Http/routes.php';
        /*
        |--------------------------------------------------------------------------
        | Register the Admin Alias
        |--------------------------------------------------------------------------
        */

        $loader = AliasLoader::getInstance();
        $loader->alias('Common', \Penmedia\Common\Models\Common::class);
        $loader->alias('Penmedia_Form', \Penmedia\Common\Http\Classes\Penmedia_Form::class);
        
        /*
        |--------------------------------------------------------------------------
        | Register the Controllers
        |--------------------------------------------------------------------------
        */
        $this->app->make('Penmedia\Common\Http\Controllers\HomeController');
    }

}
