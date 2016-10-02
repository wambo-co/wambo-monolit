<?php
namespace Wambo\Checkout\Model\Order;

use Money\Money;
use Wambo\Core\Model\Qty;
use Wambo\Core\Model\SKU;

/**
 * Interface OrderItemInterface
 * @package Wambo\Checkout\Model\Order
 */
interface OrderItemInterface
{
    /**
     * OrderItemInterface constructor.
     * @param SKU $sku
     * @param Qty $qty
     * @param Money $price
     */
    public function __construct(SKU $sku, Qty $qty, Money $price);

    /**
     * @return SKU
     */
    public function getSKU() : SKU;

    /**
     * @return Qty
     */
    public function getQty() : Qty;

    /**
     * @return Money
     */
    public function getPrice() : Money;
}