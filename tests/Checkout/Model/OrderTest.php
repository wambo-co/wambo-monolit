<?php
namespace Wambo\Checkout\Model;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Wambo\Checkout\Model\Cart\CartInterface;
use Wambo\Checkout\Model\Order\OrderItemInterface;
use Wambo\Checkout\Model\Payment\PaymentInterface;
use Wambo\Checkout\Model\Shipment\ShipmentInterface;
use Wambo\Checkout\Model\Order\Order;

/**
 * Class OrderTest
 * @package Wambo\Checkout\Model
 */
class OrderTest extends TestCase
{

    /**
     * @Test
     * Create a new valid Order (EntityObject)
     *
     * A Order is always composed of:
     *  - Cart
     *  - Payment
     *  - Shipment
     *  - OrderItems
     *  - OrderPlugins
     */
    public function test_constructor()
    {
        //arrange
        /** @var PaymentInterface $payment */
        $payment = $this->createMock(PaymentInterface::class);
        /** @var ShipmentInterface $shipment */
        $shipment = $this->createMock(ShipmentInterface::class);
        $id = Uuid::uuid4();

        $items = [
            $this->createMock(OrderItemInterface::class)
        ];

        $plugins = [];

        // act
        $order = new Order($id, $payment, $shipment, $items, $plugins);

        // assert
        $this->assertNotNull($order);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function test_constructor_invalid_items()
    {
        //arrange
        /** @var PaymentInterface $payment */
        $payment = $this->createMock(PaymentInterface::class);
        /** @var ShipmentInterface $shipment */
        $shipment = $this->createMock(ShipmentInterface::class);
        $id = Uuid::uuid4();

        $items = [3, 'item'];

        $plugins = [];

        // act
        new Order($id, $payment, $shipment, $items, $plugins);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function test_constructor_empty_items_array()
    {
        //arrange
        /** @var PaymentInterface $payment */
        $payment = $this->createMock(PaymentInterface::class);
        /** @var ShipmentInterface $shipment */
        $shipment = $this->createMock(ShipmentInterface::class);
        $id = Uuid::uuid4();

        $items = [];

        $plugins = [];

        // act
        new Order($id, $payment, $shipment, $items, $plugins);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function test_constructor_invalid_plugins()
    {
        //arrange
        /** @var PaymentInterface $payment */
        $payment = $this->createMock(PaymentInterface::class);
        /** @var ShipmentInterface $shipment */
        $shipment = $this->createMock(ShipmentInterface::class);
        $id = Uuid::uuid4();

        $items = [
            $this->createMock(OrderItemInterface::class)
        ];

        $plugins = ['asdf'];

        // act
        new Order($id, $payment, $shipment, $items, $plugins);
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function test_constructor_valid_plugins()
    {
        //arrange
        /** @var PaymentInterface $payment */
        $payment = $this->createMock(PaymentInterface::class);
        /** @var ShipmentInterface $shipment */
        $shipment = $this->createMock(ShipmentInterface::class);
        $id = Uuid::uuid4();

        $items = [
            $this->createMock(OrderItemInterface::class)
        ];

        $plugins = [
            $this->createMock(OrderPluginInterface::class)
        ];

        // act
        $order = new Order($id, $payment, $shipment, $items, $plugins);
    }
}