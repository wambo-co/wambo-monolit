<?php
namespace Wambo\Cart\Model;


use Money\Money;
use Wambo\Product\Model\ProductExtensionInterface;

class CartProductExtension implements ProductExtensionInterface
{
    /**
     * @var Money
     */
    private $price;

    public function __construct(Money $price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

}