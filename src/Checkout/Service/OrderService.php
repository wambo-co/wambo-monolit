<?php

namespace Wambo\Checkout\Service;

use Ramsey\Uuid\Uuid;
use Wambo\Checkout\Model\Cart\CartInterface;
use Wambo\Checkout\Model\Order\Order;
use Wambo\Checkout\Model\Order\OrderInterface;

/**
 * Class OrderFactoryService
 * @package Wambo\Checkout\Service
 */
class OrderService
{

    /**
     * @param CartInterface $cart
     * @return OrderInterface
     */
    public static function createOrder(CartInterface $cart) : OrderInterface
    {
        $id = Uuid::uuid4();

        $payment = $cart->getPayment();
        $shipment = $cart->getShipment();

        $orderItems = [];
        foreach($cart->getItems() as $cartItem) {
            $orderItems[] = OrderItemService::createOrderItem($cartItem);
        }

        $order = new Order($id, $payment,$shipment,$orderItems);
        return $order;
    }
}