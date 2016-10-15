<?php
namespace Wambo\Product\Model;

use PHPUnit\Framework\TestCase;
use Wambo\Core\Model\SKU;
use Wambo\Product\Model\Product;

class ProductTest extends TestCase
{

    public function test_createNewProduct()
    {
        // arrange
        $sku = new SKU('random-sku-123');
        $attributes = ['somekey' => 'value'];

        // act
        $product = new Product($sku, $attributes);

        // assert
        $this->assertEquals($sku, $product->getSku());
        $this->assertEquals($attributes, $product->getAttributes());
    }
}