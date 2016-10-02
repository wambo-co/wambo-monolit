<?php

namespace Wambo\Core\Model;

use Money\Money;

/**
 * Class Total
 * @package Wambo\Cart\Model
 */
class Total implements TotalInterface
{

    /**
     * @var Money
     */
    private $subTotal;

    /**
     * @var Money
     */
    private $grandTotal;

    /**
     * @var TotalItemInterface[]
     */
    private $totals = [];

    /**
     * Totals constructor.
     * @param Money $subTotal
     */
    public function __construct(Money $subTotal)
    {
        $this->subTotal = $subTotal;
        $this->grandTotal = $subTotal;
    }

    public function getSubTotal() : Money
    {
        return $this->subTotal;
    }

    /**
     * @param TotalItemInterface $total
     */
    public function addTotalItem(TotalItemInterface $total)
    {
        array_push($this->totals, $total);
        $this->sortTotals();
    }

    /**
     * @return array
     */
    public function getTotalItems() : array
    {
        return $this->totals;
    }

    /**
     * Sort Totals by total->getSort()
     */
    private function sortTotals()
    {
        usort($this->totals, function($a, $b){
            if ($a->getSort() == $b->getSort()) {
                return 0;
            }
            return ($a->getSort() < $b->getSort() ) ? -1 : 1;
        });
    }

    /**
     * @return Money
     */
    public function getGrandTotal(): Money
    {
        return $this->grandTotal;
    }

    /**
     * @param Money $grandTotal
     */
    public function setGrandTotal(Money $grandTotal)
    {
        $this->grandTotal = $grandTotal;
    }
}