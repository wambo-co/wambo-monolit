<?php
namespace Wambo\Cart\Service\Storage;

use Wambo\Cart\Model\Cart;

/**
 * The CartRepositoryInterface interface provides read/write access to Carts.
 *
 * @package Wambo\Cart\Storage
 */
interface CartRepositoryInterface
{
    /**
     * Get the cart with the given identifier
     *
     * @param string $cartIdentifier A cart identifier
     *
     * @return Cart
     */
    public function getCart(string $cartIdentifier) : Cart;

    /**
     * Save the given cart.
     *
     * @param Cart $cart
     */
    public function saveCart(Cart $cart);
}