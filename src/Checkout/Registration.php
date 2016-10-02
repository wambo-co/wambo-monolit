<?php

namespace Wambo\Checkout;

use Wambo\Core\App;
use Wambo\Core\Module\ModuleBootstrapInterface;

class Registration implements ModuleBootstrapInterface
{
    /**
     * Register the Checkout module.
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->configureDI($app);
        $this->registerRoutes($app);
    }

    /**
     * Register routes in the slim app.
     *
     * @param App $app
     */
    private function registerRoutes(App $app)
    {
    }

    /**
     * Configure the dependency injection container
     *
     * @param App $app
     */
    private function configureDI(App $app)
    {
        $container = $app->getContainer();
    }
}