<?php
namespace Wambo\Product\Service\Factory;

use Wambo\Product\Model\Product;
use Wambo\Product\Service\Mapper\ProductMapper;
use Wambo\Product\Service\Mapper\ProductMapperInterface;

class ProductFactory
{
    private $productMapper;

    private $extensionProductMapper;

    public function __construct(ProductMapper $productMapper, array $extensionProductMapper)
    {
        $this->productMapper = $productMapper;
        $this->extensionProductMapper = $extensionProductMapper;
    }

    public function getProduct($rawProductData) : Product
    {
        $product = $this->productMapper->getProduct($rawProductData);

        /** @var ProductMapperInterface $mapper */
        foreach($this->extensionProductMapper as $mapper){
            $mapper->getProduct($product, $rawProductData);
        }

        return $product;
    }

}