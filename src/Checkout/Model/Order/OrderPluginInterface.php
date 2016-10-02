<?php
namespace Wambo\Checkout\Model\Order;

interface OrderPluginInterface
{
    public function execute(Order $cart);
}