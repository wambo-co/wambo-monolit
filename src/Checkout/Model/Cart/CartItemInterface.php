<?php
namespace Wambo\Checkout\Model\Cart;

use Money\Money;
use Wambo\Core\Model\Qty;
use Wambo\Core\Model\SKU;

interface CartItemInterface
{
    public function getSku() : SKU;
    public function getQty() : Qty;
    public function getPrice() : Money;
}