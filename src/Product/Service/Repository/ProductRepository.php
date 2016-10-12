<?php
namespace Wambo\Product\Service\Repository;

use League\Flysystem\Exception;
use Wambo\Core\Storage\StorageInterface;
use Wambo\Frontend\Model\Slug;
use Wambo\Frontend\Service\FrontendProductProvider;
use Wambo\Product\Model\Product;
use Wambo\Product\Service\Factory\ProductFactory;
use Wambo\Product\Service\Mapper\ProductMapper;
use Wambo\Product\Service\Repository\Exception\RepositoryException;

/**
 * Class ProductRepository fetches Product models from the Storage and writes Products back to the Storage
 *
 * @package Wambo\Catalog
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var StorageInterface
     */
    private $productStorage;

    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * Creates a new ProductRepository instance.
     *
     * @param StorageInterface $productStorage A product storage for reading and writing product data
     * @param ProductFactory $productFactory
     */
    public function __construct(StorageInterface $productStorage, ProductFactory $productFactory)
    {
        $this->productStorage = $productStorage;
        $this->productFactory = $productFactory;
    }

    /**
     * Get all products
     *
     * @return Product[]
     *
     * @throws RepositoryException If fetching the products failed
     */
    public function getProducts()
    {
        try {

            // read product data from storage
            $productDataArray = $this->productStorage->read();

            // deserialize the product data
            $products = [];
            foreach ($productDataArray as $productData) {
                $products[] = $this->productFactory->getProduct($productData);
            }

            return $products;

        } catch (\Exception $readException) {
            throw new RepositoryException("Failed to read products from storage provider.", $readException);
        }
    }

    public function getProductBySlug(Slug $slug) : Product
    {
        foreach( $this->getProducts() as $product){
            $frontendProductExtension = FrontendProductProvider::getFrontendProductExtension($product);
            if($frontendProductExtension->getSlug() == $slug){
                return $product;
            }
        }
        throw new Exception('Product not found!');
    }


    public function getById(string $id)
    {
        throw new RepositoryException("Not implemented yet");
    }

    public function add(Product $product)
    {
        throw new RepositoryException("Not implemented yet");
    }

    public function remove(Product $product)
    {
        throw new RepositoryException("Not implemented yet");
    }
}