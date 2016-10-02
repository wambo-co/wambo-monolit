<?php

namespace Wambo\Cart\Model;

use Money\Money;
use Wambo\Checkout\Model\Cart\CartItemInterface;
use Wambo\Core\Model\Qty;
use Wambo\Core\Model\SKU;

/**
 * Class CartItem represents a single cart item.
 *
 * @package Wambo\Cart\Model
 */
class CartItem implements CartItemInterface
{
    /**
     * @var SKU
     */
    private $sku;

    /**
     * @var Qty
     */
    private $qty;

    /**
     * @var Money
     */
    private $price;

    /**
     * Create a new CartItem instance.
     *
     * @param SKU $sku The SKU of a product
     * @param Qty $qty The Qty of a item for the product
     * @param Money $price
     */
    public function __construct(SKU $sku, Qty $qty, Money $price)
    {
        $this->sku = $sku;
        $this->qty = $qty;
        $this->price = $price;
    }

    /**
     * Get the SKU of the product.
     *
     * @return SKU
     */
    public function getSku(): SKU
    {
        return $this->sku;
    }

    /**
     * @return Qty
     */
    public function getQty() : Qty
    {
        return $this->qty;
    }

    /**
     * @return Money
     */
    public function getPrice() : Money
    {
        return $this->price;
    }
}