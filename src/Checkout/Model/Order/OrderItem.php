<?php
namespace Wambo\Checkout\Model\Order;

use Money\Money;
use Wambo\Core\Model\Qty;
use Wambo\Core\Model\SKU;

/**
 * Class OrderItem
 * @package Wambo\Checkout\Model\Order
 */
class OrderItem implements OrderItemInterface
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
     * OrderItem constructor.
     * @param SKU $sku
     * @param Qty $qty
     * @param Money $price
     */
    public function __construct(SKU $sku, Qty $qty, Money $price)
    {
        $this->sku = $sku;
        $this->qty = $qty;
        $this->price = $price;
    }

    /**
     * @return SKU
     */
    public function getSku() : SKU
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