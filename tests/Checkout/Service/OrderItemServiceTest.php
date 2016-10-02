<?php
namespace Wambo\Checkout\Service;

use Money\Money;
use PHPUnit\Framework\TestCase;
use Wambo\Checkout\Model\Cart\CartItemInterface;
use Wambo\Core\Model\SKU;

class OrderItemServiceTest extends TestCase
{
    public function test_create_orderItem_from_cartItem()
    {
        $cartItem = $this->createMock(CartItemInterface::class);
        $cartItem->method('getSKU')->willReturn($this->createMock(SKU::class));
        $cartItem->method('getPrice')->willReturn( Money::EUR(123) );

        /** @var CartItemInterface $cartItem */
        $orderItem = OrderItemService::createOrderItem($cartItem);
    }
}