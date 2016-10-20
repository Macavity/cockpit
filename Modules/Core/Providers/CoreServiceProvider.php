<?php

namespace Modules\Core\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Blade;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Composers\NavigationComposer;
use Modules\Core\Http\Middleware\CoreAuthenticate;
use Modules\Core\Http\Middleware\CoreGuest;
use Modules\Core\Http\Middleware\CoreUserHasAccess;
use Modules\Core\Http\Middleware\CoreUserInRole;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     *
     * @var array
     */
    protected $routeMiddleware = [
        'core.guest' => CoreGuest::class,
        'core.auth' => CoreAuthenticate::class,
        'core.role' => CoreUserInRole::class,
        'core.access' => CoreUserHasAccess::class,
    ];

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiddleware();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerNavigationComposer();
        $this->registerViews();
        $this->registerViewHelpers();

        $this->registerThemes();
        $this->registerThemeViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Register the filters.
     *
     * @return void
     */
    public function registerMiddleware()
    {
        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->middleware($key, $middleware);
        }
    }

    public function registerNavigationComposer()
    {
        view()->composer('layouts.partials.navbar-top', NavigationComposer::class);
        view()->composer('layouts.partials.navbar-user', NavigationComposer::class);
        view()->composer('layouts.partials.sidebar', NavigationComposer::class);
        view()->composer('layouts.master', NavigationComposer::class);
    }

    public function registerThemes()
    {
        app('stylist')->registerPath(base_path('/Themes/Base'), true);
    }

    public function registerThemeViews()
    {
        $currentTheme = config('stylist.themes.activate');
        $slug = strtolower($currentTheme);

        $viewPath = base_path('Themes/'.$currentTheme);

        $sourcePath = __DIR__.'/../../../Themes/'.$currentTheme.'/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom($viewPath, $slug);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('core.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'core'
        );
    }

    public function registerViewHelpers()
    {
        Blade::directive('role', function($expression) {
            return "<?php if (\\Sentinel::inRole({$expression})) : ?>";
        });

        // Call to Entrust::can
        Blade::directive('access', function($expression) {
            return "<?php if (\\Sentinel::hasAccess({$expression})) : ?>";
        });
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/core');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/core';
        }, \Config::get('view.paths')), [$sourcePath]), 'core');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/core');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'core');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'core');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
