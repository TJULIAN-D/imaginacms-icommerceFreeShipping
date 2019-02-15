<?php

namespace Modules\IcommerceFreeshipping\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\IcommerceFreeshipping\Events\Handlers\RegisterIcommerceFreeshippingSidebar;

class IcommerceFreeshippingServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIcommerceFreeshippingSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('configurations', array_dot(trans('icommercefreeshipping::configurations')));
            // append translations

        });
    }

    public function boot()
    {
      $this->publishConfig('IcommerceFreeshipping', 'permissions');
      $this->publishConfig('IcommerceFreeshipping', 'settings');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\IcommerceFreeshipping\Repositories\ConfigurationRepository',
            function () {
                $repository = new \Modules\IcommerceFreeshipping\Repositories\Eloquent\EloquentConfigurationRepository(new \Modules\IcommerceFreeshipping\Entities\Configfreeshipping());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\IcommerceFreeshipping\Repositories\Cache\CacheConfigurationDecorator($repository);
            }
        );
// add bindings

    }
}
