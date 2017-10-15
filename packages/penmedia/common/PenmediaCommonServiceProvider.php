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
        $this->loadTranslationsFrom($this->app->basePath(). '/packages/penmedia/common/resources/lang', 'penmedia\common' );


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

    }

}
