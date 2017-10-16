<?php

namespace Penmedia\Admin;

use Artisan;
use Illuminate\Support\Facades\Blade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;


class PenmediaAdminServiceProvider extends ServiceProvider
{
    protected $middleware = [
        'auth' => 'App\Http\Middleware\Authenticate'
    ];
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'admin');

        $this->publishes([
            __DIR__ . '/resources/views' => base_path('packages/admin/resources/views')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/Http/routes.php';

        // For LAEditor
        if(file_exists(__DIR__.'/../../laeditor')) {
            include __DIR__.'/../../laeditor/src/routes.php';
        }
        
        /*
        |--------------------------------------------------------------------------
        | Providers
        |--------------------------------------------------------------------------
        */
        
        // Collective HTML & Form Helper
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        // For Datatables
        $this->app->register(\Yajra\Datatables\DatatablesServiceProvider::class);
        // For Gravatar
        $this->app->register(\Creativeorange\Gravatar\GravatarServiceProvider::class);
        // For Entrust
        $this->app->register(\Zizaco\Entrust\EntrustServiceProvider::class);
        // For Spatie Backup
        $this->app->register(\Spatie\Backup\BackupServiceProvider::class);
        
        /*
        |--------------------------------------------------------------------------
        | Register the Alias
        |--------------------------------------------------------------------------
        */
        
        $loader = AliasLoader::getInstance();
        
        // Collective HTML & Form Helper
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('HTML', \Collective\Html\HtmlFacade::class);
        
        // For Gravatar User Profile Pics
        $loader->alias('Gravatar', \Creativeorange\Gravatar\Facades\Gravatar::class);
        
        // For LaraAdmin Code Generation
        $loader->alias('CodeGenerator', \Dwij\Laraadmin\CodeGenerator::class);
        
        // For LaraAdmin Form Helper
        $loader->alias('LAFormMaker', \Dwij\Laraadmin\LAFormMaker::class);
        
        // For LaraAdmin Helper
        $loader->alias('LAHelper', \Dwij\Laraadmin\Helpers\LAHelper::class);
        
        // LaraAdmin Module Model 
        $loader->alias('Module', \Dwij\Laraadmin\Models\Module::class);

        // For LaraAdmin Configuration Model
        $loader->alias('LAConfigs', \Dwij\Laraadmin\Models\LAConfigs::class);
        
        // For Entrust
        $loader->alias('Entrust', \Zizaco\Entrust\EntrustFacade::class);
        $loader->alias('role', \Zizaco\Entrust\Middleware\EntrustRole::class);
        $loader->alias('permission', \Zizaco\Entrust\Middleware\EntrustPermission::class);
        $loader->alias('ability', \Zizaco\Entrust\Middleware\EntrustAbility::class);
        
        /*
        |--------------------------------------------------------------------------
        | Register the Controllers
        |--------------------------------------------------------------------------
        */
        $this->app->make('App\Http\Controllers\Auth\AuthController');
        $this->app->make('Dwij\Laraadmin\Controllers\ModuleController');
        $this->app->make('Dwij\Laraadmin\Controllers\FieldController');
        $this->app->make('Dwij\Laraadmin\Controllers\MenuController');
        
        // For LAEditor
        if(file_exists(__DIR__.'/../../laeditor')) {
            $this->app->make('Dwij\Laeditor\Controllers\CodeEditorController');
        }

    }
}
