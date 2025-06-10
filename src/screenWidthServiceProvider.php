<?php

namespace screenWidth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use screenWidth\app\Http\Middleware\screenWidth;

class screenWidthServiceProvider extends ServiceProvider
{
    public $routeFilePath = '/routes/screenWidth.php';
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->loadViewsWithFallbacks();
        $this->loadConfigs();
        $this->registerMiddlewareGroup($this->app->router);
        $this->setupRoutes($this->app->router);
        $this->loadBladeDirectives();
        $this->publishFiles();
    }
    public function loadViewsWithFallbacks()
    {
        $webappViewFolder = resource_path('views/vendor/screenwidth');
        if (file_exists($webappViewFolder)) {
            $this->loadViewsFrom($webappViewFolder, 'screenWidth');
        }
        $this->loadViewsFrom(realpath(__DIR__ . '/resources/views'), 'screenWidth');
    }
    public function loadConfigs()
    {
        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(__DIR__ . '/config/package/screenWidth.php', 'package.screenWidth');
    }
    public function registerMiddlewareGroup(Router $router)
    {
        $middleware_class = [
            screenWidth::class,
        ];
        foreach ($middleware_class as $middleware_class) {
            $router->pushMiddlewareToGroup('screenWidth', $middleware_class);
        }
    }
    public function setupRoutes(Router $router)
    {
        $routeFilePathInUse = __DIR__ . $this->routeFilePath;
        $this->loadRoutesFrom($routeFilePathInUse);
    }
    public function loadBladeDirectives()
    {
        Blade::directive('screenWidth_reportWindowSize', function () {
            return view('screenWidth::screenWidth.reportWindowSize');
        });
    }
    public function publishFiles()
    {
        $screenWidth_config_files = [__DIR__ . '/config' => config_path()];
        // establish the minimum amount of files that need to be published, for screenWidth to work; there are the files that will be published by the install command
        $minimum = array_merge(
            $screenWidth_config_files,
        );
        // register all possible publish commands and assign tags to each
        $this->publishes($screenWidth_config_files, 'config');
    }
    public function loadHelpers()
    {
        require_once __DIR__ . '/helpers.php';
    }
    public function register()
    {
        $this->loadHelpers();
    }
    static public function checkLoading()
    {
        return 'Hii, it is loading';
    }
}
