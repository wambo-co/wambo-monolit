<?php
namespace Wambo\Checkout\Model\Order;

use Exception;
use Ramsey\Uuid\UuidInterface;
use Wambo\Checkout\Model\Payment\PaymentInterface;
use Wambo\Checkout\Model\Shipment\ShipmentInterface;
use Wambo\Core\Model\Total;

/**
 * Class Order
 * @package Wambo\Checkout\Model\Order
 */
class Order implements OrderInterface
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var PaymentInterface
     */
    private $payment;

    /**
     * @var ShipmentInterface
     */
    private $shipment;

    /**
     * @var array
     */
    private $items;

    /**
     * @var array
     */
    private $plugins;

    /**
     * @var Total
     */
    private $totals;


    /**
     * Order constructor.
     * @param UuidInterface $id
     * @param PaymentInterface $payment
     * @param ShipmentInterface $shipment
     * @param array $items
     * @param array $plugins
     *
     * @throws Exception
     */
    public function __construct(
        UuidInterface $id,
        PaymentInterface $payment,
        ShipmentInterface $shipment,
        array $items,
        array $plugins = []
    )
    {
        $this->id       = $id;
        $this->payment  = $payment;
        $this->shipment = $shipment;


        if(count($items) < 1){
            throw new Exception('Order items can not empty');
        }
        foreach($items as $item){
            if(! $item instanceof OrderItemInterface){
                throw new Exception('all items must be instances of OrderItemInterface');
            }
        }
        $this->items    = $items;

        foreach($plugins as $plugin){
            if(! $plugin instanceof OrderPluginInterface){
                throw new Exception('all plugins must be instances of OrderPluginInterface');
            }
        }
        $this->plugins  = $plugins;

        $this->executePlugins();
    }

    private function executePlugins()
    {
        /** @var OrderPluginInterface $plugin */
        foreach($this->plugins as $plugin)
        {
            $plugin->execute($this);
        }
    }

    public function getId() : UuidInterface
    {
        return $this->id;
    }
}