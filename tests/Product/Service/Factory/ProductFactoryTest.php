<?php
namespace Wambo\Product\Service\Factory;

use PHPUnit\Framework\TestCase;
use Wambo\Frontend\Service\Mapper\FrontendProductMapper;
use Wambo\Frontend\Service\FrontendProductProvider;
use Wambo\Product\Model\Product;
use Wambo\Product\Service\Mapper\ProductMapper;

class ProductFactoryTest extends TestCase
{

    public function test_build_products()
    {
        $productFactory = new ProductFactory(
            new ProductMapper(),
            [
                new FrontendProductMapper()
            ]
        );

        $product = $productFactory->getProduct( $this->getBasicProductDataAsArray() );
        $productWithSaleableInterface = $productFactory->getProduct( $this->getProductForSaleableProductDataAsArray() );

        $this->assertInstanceOf(Product::class, $product);
        $this->assertInstanceOf(Product::class, $productWithSaleableInterface);

        $frontendProductProvider = FrontendProductProvider::getFrontendProductExtension($productWithSaleableInterface);
        echo $frontendProductProvider->getSlug();
    }


    private function getBasicProductDataAsArray()
    {
        return [
            'sku' => 'foo-123',
            'slug' => 'my_url',
            'summary' => "Our T-Shirt No. 1",
            'description' => 'Our fancy T-Shirt No. 1 is ...'
        ];
    }


    private function getProductForSaleableProductDataAsArray()
    {
        return array_merge(
            $this->getBasicProductDataAsArray(),
            [
                'slug' => 'asdf',
                'price' => [
                    'amount' => 123,
                    'currency' => 'EUR'
                ]
            ]
        );
    }
}