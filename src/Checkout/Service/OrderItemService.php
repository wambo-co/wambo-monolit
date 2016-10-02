<?php
namespace Wambo\Checkout\Service;

use Wambo\Checkout\Model\Cart\CartItemInterface;
use Wambo\Checkout\Model\Order\OrderItem;
use Wambo\Checkout\Model\Order\OrderItemInterface;

class OrderItemService
{
    public static function createOrderItem(CartItemInterface $item) : OrderItemInterface
    {
        $sku = $item->getSku();
        $qty = $item->getQty();
        $price = $item->getPrice();
        $orderItem = new OrderItem($sku, $qty, $price);
        return $orderItem;
    }
}