<?php
namespace Wambo\Product;

use Wambo\Core\App;
use Wambo\Core\Module\ModuleBootstrapInterface;
use Wambo\Product\Controller\ProductController;

class Registration implements ModuleBootstrapInterface
{

    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;

        $this->registerRoutes();
        $this->configureDI();
    }

    private function registerRoutes()
    {
        // overview
        $this->app->get("/", ['ProductController', 'overview'])->setName("overview");

        // product details
        $this->app->get("/product/{slug}", ['ProductController', 'productDetails'])->setName("product_details");
    }

    private function configureDI()
    {
        $this->app->getContainer()->set('ProductController', \DI\object(ProductController::class));
    }
}