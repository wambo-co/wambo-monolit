<?php
namespace Wambo\Cart\Service\Mapper;

use Wambo\Cart\Model\SaleableProduct;
use Wambo\Product\Service\Mapper\ProductMapper;
use Wambo\Product\Model\Product;
use Wambo\Product\Service\Mapper\ProductMapperInterface;

class SaleableProductMapper implements ProductMapperInterface
{
    public function condition(array $rawProductData) : bool
    {
        if( isset( $rawProductData['price'] ) ){
            return true;
        }

        return false;
    }

    public function map(array $rawProductData) : Product
    {
        $productMapper = new ProductMapper();
        $product = $productMapper->map($rawProductData);

        $price = $rawProductData['price'];
        unset($rawProductData['price']);

        $saleableProduct = new SaleableProduct($product, $price);
        return $saleableProduct;
    }

}