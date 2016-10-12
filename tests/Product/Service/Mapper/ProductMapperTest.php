<?php
namespace Wambo\Product\Service\Mapper;

use PHPUnit\Framework\TestCase;
use Wambo\Product\Model\Exception\ProductException;
use Wambo\Product\Model\Product;

class ProductMapperTest extends TestCase
{
    /**
     * @test
     * @dataProvider rawDataProvider
     *
     * @param $valid
     * @param $rawProductData
     */
    public function test_is_mappable($valid, $rawProductData)
    {
        // arrange
        $productMapper = new ProductMapper();

        // act
        $isMappable = $productMapper->isMappable($rawProductData);

        // assert
        $this->assertEquals($valid, $isMappable);
    }

    /**
     * @test
     */
    public function test_map_valid_raw_data_to_product()
    {
        // arrange
        $productMapper = new ProductMapper();

        // act
        $product = $productMapper->getProduct($this->getValidRawProductData());

        // assert
        $this->assertInstanceOf(Product::class, $product);
    }

    /**
     * @test
     */
    public function test_map_invalid_raw_data_to_product()
    {
        // arrange
        $productMapper = new ProductMapper();

        // assert
        $this->expectException(ProductException::class);

        // act
        $productMapper->getProduct($this->getInValidRawProductData());
    }

    public function rawDataProvider() : array
    {
        return [
            // valid
            [
                'valid' => true,
                'rawProductData' => $this->getValidRawProductData()
            ],

            // invalid (no sku field included)
            [
                'valid' => false,
                'rawProductData' => $this->getInValidRawProductData()
            ]
        ];
    }

    private function getValidRawProductData() : array
    {
        return [
            'sku' => 'random-sku-123',
            'foo' => 'bar'
        ];
    }

    private function getInValidRawProductData() : array
    {
        return [
            'no-sku' => 'random-sku-123',
            'foo' => 'bar'
        ];
    }

}