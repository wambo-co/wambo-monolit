<?php
namespace Wambo\Cart\Model;

use Wambo\Core\Model\TotalItem;

class TaxCartPlugin implements CartPluginInterface
{
    const NAME = 'tax';

    /**
     * @var float
     */
    private $taxRate;

    /**
     * TaxCartPlugin constructor.
     * @param float $taxRate
     */
    public function __construct(float $taxRate)
    {
        $this->taxRate = $taxRate;
    }

    /**
     * @param Cart $cart
     */
    public function execute(Cart $cart)
    {
        $total = $cart->getTotal();
        $subtotal = $total->getSubTotal();

        $taxAmount = $subtotal->multiply($this->taxRate);

        $totalItem = new TotalItem(self::NAME, $taxAmount, 1);
        $total->addTotalItem($totalItem);

        $newGrandTotal = $total->getGrandTotal()->add($taxAmount);

        $total->setGrandTotal($newGrandTotal);

    }
}