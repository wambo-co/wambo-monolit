<?php
namespace Wambo;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Cache\CacheItemPoolInterface;
use Stash\Pool;
use Wambo\Cart\Service\Mapper\CartProductMapper;
use Wambo\Core\Module\JSONModuleStorage;
use Wambo\Cart\Service\Storage\CartRepositoryInterface;
use Wambo\Cart\Service\Storage\CartRepository;
use Wambo\Frontend\Service\Mapper\FrontendProductMapper;
use Wambo\Product\Service\Factory\ProductFactory;
use Wambo\Product\Service\Mapper\ProductMapper;
use Wambo\Product\Service\Repository\CachedProductRepository;
use Wambo\Product\Service\Repository\ProductRepository;
use Wambo\Product\Service\Repository\ProductRepositoryInterface;

return [
    'settings.httpVersion' => '1.1',
    'settings.responseChunkSize' => 4096,
    'settings.outputBuffering' => 'append',
    'settings.determineRouteBeforeAppMiddleware' => false,
    'settings.displayErrorDetails' => true,
    'settings.addContentLengthHeader' => true,
    'settings.routerCacheFile' => false,

    'settings.debug'         => true,
    'settings.whoops.editor' => 'sublime',

    'settings' => [
        'httpVersion' => \DI\get('settings.httpVersion'),
        'responseChunkSize' => \DI\get('settings.responseChunkSize'),
        'outputBuffering' => \DI\get('settings.outputBuffering'),
        'determineRouteBeforeAppMiddleware' => \DI\get('settings.determineRouteBeforeAppMiddleware'),
        'displayErrorDetails' => \DI\get('settings.displayErrorDetails'),
        'addContentLengthHeader' => \DI\get('settings.addContentLengthHeader'),
        'routerCacheFile' => \DI\get('settings.routerCacheFile'),
        'debug'         => \DI\get('settings.debug'),
        'whoops.editor' => \DI\get('settings.whoops.editor')
    ],

    // local filesystem
    Filesystem::class => function () {
        return new Filesystem(new Local(WAMBO_ROOT_DIR));
    },

    // cache
    CacheItemPoolInterface::class => function () {
        $cache = new Pool();
        return $cache;
    },

    // product repository
    ProductRepositoryInterface::class => function (CacheItemPoolInterface $cache, Filesystem $filesystem) {
        $storage = new JSONModuleStorage($filesystem, "data/catalog.json");

        // product mapper
        $productMapper = new ProductMapper();
        $productFactory = new ProductFactory($productMapper, [
            new FrontendProductMapper(),
            new CartProductMapper()
        ]);

        // create the product repository
        $productRepository = new ProductRepository($storage, $productFactory);

        // create a cached version of the product repository
        $cachedProductRepository = new CachedProductRepository($cache, $productRepository);
        return $cachedProductRepository;
    },

    // Cart Repository
    CartRepositoryInterface::class => function (Filesystem $filesystem) {
        $cartStorage = new JSONModuleStorage($filesystem, "var/carts.json");
        return new CartRepository($cartStorage);
    }

];
