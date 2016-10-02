<?php
namespace Wambo\Cart\Model;

use Money\Currency;
use Money\Money;
use Wambo\Checkout\Model\Cart\CartInterface;
use Wambo\Checkout\Model\Payment\PaymentInterface;
use Wambo\Checkout\Model\Shipment\ShipmentInterface;
use Wambo\Core\Model\Total;
use Wambo\Core\Model\TotalInterface;

/**
 * Class Cart is the shopping cart model.
 *
 * @package Wambo\Cart\Model
 */
class Cart implements CartInterface
{
    /**
     * @var string
     */
    private $cartIdentifier;

    /**
     * @var CartItem[] $cartItems
     */
    private $cartItems;

    /**
     * @var CartPluginInterface[] $plugins
     */
    private $plugins;

    /**
     * @var Total $total
     */
    private $total;

    /**
     * Create a new Cart instance.
     *
     * @param string $cartIdentifier A cart identifier
     * @param array $cartItems A array of cart items
     * @param array $plugins A array of cart plugins
     */
    public function __construct(string $cartIdentifier, array $cartItems = [], array $plugins = [])
    {
        $this->cartIdentifier = $cartIdentifier;
        $this->cartItems = $cartItems;
        $this->plugins = $plugins;

        $cartItemSum = $this->getCartItemSum();
        $this->total = new Total($cartItemSum);

        $this->executeCartPlugins();
    }

    /**
     * @return string
     */
    public function getCartIdentifier(): string
    {
        return $this->cartIdentifier;
    }

    /**
     * Get all cart items
     *
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->cartItems;
    }

    /**
     * @return TotalInterface
     */
    public function getTotal() : TotalInterface
    {
        return $this->total;
    }

    /**
     * execute all cart Items
     */
    private function executeCartPlugins()
    {
        foreach($this->plugins as $plugin){
            $plugin->execute($this);
        }
    }

    /**
     * @return Money
     */
    private function getCartItemSum()
    {
        $cartItemSum = new Money(0, new Currency('EUR'));
        foreach($this->cartItems as $item){
            $cartItemSum = $cartItemSum->add($item->getPrice()->multiply($item->getQty()->getValue()));
        }
        return $cartItemSum;
    }

    public function getPayment() : PaymentInterface
    {
        // TODO: Implement getPayment() method.
    }

    public function getShipment() : ShipmentInterface
    {
        // TODO: Implement getShipment() method.
    }
}