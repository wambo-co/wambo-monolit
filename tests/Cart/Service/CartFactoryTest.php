<?php
namespace Wambo\Cart\Service;

use PHPUnit\Framework\TestCase;

class CartFactoryTest extends TestCase
{
    public function test_createCart()
    {
        // arrange
        $cartFactory = new CartFactory();

        // act
        $cart = $cartFactory->createCart();
    }
}