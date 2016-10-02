<?php
namespace Wambo\Checkout\Model;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Wambo\Checkout\Model\Order\OrderItem;
use Wambo\Core\Model\Qty;
use Wambo\Core\Model\SKU;

class OrderItemTest extends TestCase
{
    public function test_constructor()
    {
        // arrange
        /** @var SKU $sku */
        $sku = $this->createMock(SKU::class);
        /** @var Qty $qty */
        $qty = $this->createMock(Qty::class);
        /** @var Money $price */
        $price = new Money( 123, new Currency('EUR') );

        // act
        $orderItem = new OrderItem($sku, $qty, $price);
    }

}