<?php

namespace Wambo\Cart\ViewModel;

/**
 * Class CartViewModel
 *
 * @package Wambo\Cart\ViewModel
 */
class CartViewModel
{
    /** @var string $cartIdentifier */
    public $cartIdentifier;

    /** @var CartItemViewModel[] $items */
    public $items;
}