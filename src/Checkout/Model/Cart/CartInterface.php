<?php

namespace Wambo\Checkout\Model\Cart;

use Wambo\Checkout\Model\Payment\PaymentInterface;
use Wambo\Checkout\Model\Shipment\ShipmentInterface;
use Wambo\Core\Model\TotalInterface;

interface CartInterface
{
    public function getTotal() : TotalInterface;
    public function getItems() : array;
    public function getPayment() : PaymentInterface;
    public function getShipment() : ShipmentInterface;
}