<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Request;
use Context;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * This prefix applied to front end route;
     *
     * It is a prefix to multilinguage URL, do not add if default language
     */
    public $prefix = '';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        if (config('settings.multilingual')) {
          $this->initProcessMultilingual();
        }

        Route::prefix($this->prefix)->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /**
     * Check for first segment of the URL for language
     * @return null
     */

    protected function initProcessMultilingual()
    {
        $first_segment = Request::segment(1);
        $context = Context::getContext();
        $fallback_lang = config('app.fallback_locale');

        if ($first_segment == $fallback_lang) {
          $segments = Request::segments();
          $segments[0] = '';
          define('LOCALE_REDIRECT', url(implode('/', $segments)));
        }

        if (in_array($first_segment, config('app.locales'))) {
          $this->app->setLocale($first_segment);
          $context->lang->locale = $first_segment;
          $this->prefix = $first_segment;
        }
    }
}
