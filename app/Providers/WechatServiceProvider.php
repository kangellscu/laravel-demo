<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WechatServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \EasyWeChat\Foundation\Application::class,
            function ($app) {
                return new \EasyWeChat\Foundation\Application(
                    $app['config']['wechat']
                );
            }
        );
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            \EasyWeChat\Foundation\Application::class,
        ];
    }
}
