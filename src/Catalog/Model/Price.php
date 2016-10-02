<?php
namespace Wambo\Catalog\Model;

use Money\Money;

/**
 * Class Price
 * @package Wambo\Catalog\Model
 */
class Price implements PriceInterface
{

    /**
     * @var Money
     */
    private $price;

    /**
     * Price constructor.
     * @param Money $price
     */
    public function __construct(Money $price)
    {
        $this->price = $price;
    }

    /**
     * @return Money
     */
    public function getFinalPrice() : Money
    {
        return $this->price;
    }
}