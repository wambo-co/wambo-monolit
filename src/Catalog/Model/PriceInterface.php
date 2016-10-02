<?php
namespace Wambo\Catalog\Model;

use Money\Money;

/**
 * Interface PriceInterface
 * @package Wambo\Catalog\Model
 */
interface PriceInterface
{
    /**
     * @return Money
     */
    public function getFinalPrice() : Money;
}