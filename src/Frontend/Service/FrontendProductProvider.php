<?php
namespace Wambo\Frontend\Service;

use Wambo\Frontend\Model\FrontendProductExtension;
use Wambo\Product\Model\Product;

class FrontendProductProvider
{
    public static function getFrontendProductExtension(Product $product) : FrontendProductExtension
    {
        return $product->getExtension('frontend');
    }
}