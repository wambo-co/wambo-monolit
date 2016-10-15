<?php
namespace Wambo\Product\Service\Repository;

use Exception;
use PHPUnit\Framework\TestCase;
use Wambo\Core\Model\SKU;
use Wambo\Core\Storage\StorageInterface;
use Wambo\Product\Model\Product;
use Wambo\Product\Service\Factory\ProductFactory;
use Wambo\Product\Service\Mapper\ProductMapper;

/**
 * Class ProductRepositoryTest tests the Wambo\Catalog\ProductRepository class.
 *
 * @package Wambo\Catalog\Tests
 */
class ProductRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function getProducts_StorageReturnsEmptyArray_NoProductsAreReturned()
    {
        // arrange
        $productStorage = $this->getMockBuilder(StorageInterface::class)->getMock();
        $productStorage->method("read")->willReturn(array());
        $productFactory = $this->createMock(ProductFactory::class);

        /** @var StorageInterface $productStorage */
        /** @var ProductFactory $productFactory */
        $productRepository = new ProductRepository($productStorage, $productFactory);

        // act
        $products = $productRepository->getProducts();

        // assert
        $this->assertEmpty($products, "getProducts should not have returned an empty array");
    }

    /**
     * @test
     * @expectedException \Wambo\Product\Service\Repository\Exception\RepositoryException
     */
    public function getProducts_StorageReadThrowsException_RepositoryExceptionIsThrown()
    {
        // arrange
        $productStorage = $this->getMockBuilder(StorageInterface::class)->getMock();
        $productStorage->method("read")->willThrowException(new Exception("Some error"));

        $productFactory = $this->createMock(ProductFactory::class);


        /** @var StorageInterface $productStorage */
        /** @var ProductFactory $productFactory */
        $productRepository = new ProductRepository($productStorage, $productFactory);

        // act
        $productRepository->getProducts();
    }

    /**
     * @test
     */
    public function getProducts_StorageReturnsOneProduct_ProductMapperReturnsProduct_ProductIsReturned()
    {
        // arrange
        $productStorage = $this->getMockBuilder(StorageInterface::class)->getMock();
        $productStorage->method("read")->willReturn(array(
            [
                "sku" => "product-a"
            ],
        ));

        $productFactory = $this->getMockBuilder(ProductFactory::class)->disableOriginalConstructor()->getMock();
        $productFactory->method("getProduct")->willReturn(new Product(new SKU("product-a"), []));

        /** @var StorageInterface $productStorage */
        /** @var ProductMapper $productMapper */
        $productRepository = new ProductRepository($productStorage, $productFactory);

        // act
        $products = $productRepository->getProducts();

        // assert
        $this->assertCount(1, $products);

        /** @var Product $product */
        $product = $products[0];
        $this->assertEquals("product-a", $product->getSKU());
    }
}
