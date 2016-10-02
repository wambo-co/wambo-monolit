<?php
namespace Wambo\Core\Model;

use Money\Money;

interface TotalInterface
{
    public function __construct(Money $subTotal);
    public function getSubTotal() : Money;
    public function addTotalItem(TotalItemInterface $total);
    public function getTotalItems() : array;
    public function getGrandTotal(): Money;
    public function setGrandTotal(Money $grandTotal);
}