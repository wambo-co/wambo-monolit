<?php

namespace Wambo\Cart\Service;

use Ramsey\Uuid\Uuid;
use Wambo\Cart\Model\Cart;
use Wambo\Checkout\Model\Cart\CartInterface;

/**
 * Class CartFactory creates new Cart models.
 *
 * @package Wambo\Cart\Service
 */
class CartFactory
{

    /**
     * Create a new Cart model.
     *
     * @return CartInterface
     */
    public function createCart(): CartInterface
    {
        $cartIdentifier = Uuid::uuid4();
        return new Cart($cartIdentifier, []);
    }
}