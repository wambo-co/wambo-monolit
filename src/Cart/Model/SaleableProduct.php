<?php
namespace Wambo\Cart\Model;

use Wambo\Product\Model\Product;

class SaleableProduct extends Product implements SaleableInterface
{
    private $price;

    public function __construct(Product $product, $price)
    {
        parent::__construct($product->getSku(), $product->getAttributes());
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }
}