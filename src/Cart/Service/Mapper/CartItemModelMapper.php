<?php

namespace Wambo\Cart\Service\Mapper;

use Wambo\Cart\Model\CartItem;
use Wambo\Cart\ViewModel\CartItemViewModel;

/**
 * Class CartItemModelMapper maps cart item model to cart item view models and vice versa.
 *
 * @package Wambo\Cart\Service\Mapper
 */
class CartItemModelMapper
{
    /**
     * Get the cart item view model for the given cart item model.
     *
     * @param CartItem $cartItem A cart item model
     *
     * @return CartItemViewModel
     */
    public function getCartItemViewModel(CartItem $cartItem): CartItemViewModel
    {
        $viewModel = new CartItemViewModel();
        $viewModel->sku = $cartItem->getSku();
    }
}