<?php
namespace Wambo;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Psr\Cache\CacheItemPoolInterface;
use Stash\Pool;
use Wambo\Catalog\CachedProductRepository;
use Wambo\Catalog\Mapper\ContentMapper;
use Wambo\Catalog\Mapper\PriceMapper;
use Wambo\Catalog\Mapper\ProductMapper;
use Wambo\Catalog\ProductRepository;
use Wambo\Catalog\ProductRepositoryInterface;
use Wambo\Core\Module\JSONModuleStorage;
use Wambo\Core\Module\ModuleMapper;
use Wambo\Core\Module\ModuleRepository;
use Wambo\Cart\Service\Storage\CartRepositoryInterface;
use Wambo\Cart\Service\Storage\CartRepository;

return [
    'settings.httpVersion' => '1.1',
    'settings.responseChunkSize' => 4096,
    'settings.outputBuffering' => 'append',
    'settings.determineRouteBeforeAppMiddleware' => false,
    'settings.displayErrorDetails' => true,
    'settings.addContentLengthHeader' => true,
    'settings.routerCacheFile' => false,


    // local filesystem
    Filesystem::class => function () {
        return new Filesystem(new Local(WAMBO_ROOT_DIR));
    },

    // cache
    CacheItemPoolInterface::class => function () {
        $cache = new Pool();
        return $cache;
    },

    // Wambo modules
    ModuleRepository::class => function (Filesystem $filesystem) {
        $storage = new JSONModuleStorage($filesystem, 'vendor/modules.json');
        $mapper = new ModuleMapper();

        return new ModuleRepository($storage, $mapper);
    },

    // product repository
    ProductRepositoryInterface::class => function (CacheItemPoolInterface $cache, Filesystem $filesystem) {
        $storage = new JSONModuleStorage($filesystem, "data/catalog.json");

        // product mapper
        $contentMapper = new ContentMapper();
        $priceMapper = new PriceMapper();
        $productMapper = new ProductMapper($contentMapper, $priceMapper);

        // create the product repository
        $productRepository = new ProductRepository($storage, $productMapper);

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
