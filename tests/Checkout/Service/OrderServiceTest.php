<?php
namespace Wambo\Checkout\Service;

use Money\Money;
use PHPUnit\Framework\TestCase;
use Wambo\Checkout\Model\Cart\CartInterface;
use Wambo\Checkout\Model\Cart\CartItemInterface;

class OrderServiceTest extends TestCase
{
    public function test_create_order_form_order()
    {

        $cartItem = $this->createMock(CartItemInterface::class);
        $cartItem->method("getPrice")->willReturn( Money::EUR(123) );

        $cart = $this->createMock(CartInterface::class);
        $cart->method('getItems')->willReturn([$cartItem]);

        /** @var CartInterface $cart */
        $order = OrderService::createOrder($cart);
    }
}