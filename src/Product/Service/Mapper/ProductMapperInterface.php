<?php
namespace Wambo\Product\Service\Mapper;

use Wambo\Product\Model\Product;

interface ProductMapperInterface
{
    public function isMappable (array $rawProductData) : bool;
    public function getProduct(Product $product, array $rawProductData) : Product;
}