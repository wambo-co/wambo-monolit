<?php

namespace Wambo\Cart\Service\Mapper;

use Wambo\Cart\Model\Cart;
use Wambo\Cart\Model\CartItem;
use Wambo\Cart\ViewModel\CartItemViewModel;
use Wambo\Cart\ViewModel\CartViewModel;

/**
 * Class CartModelMapper maps Cart models to Cart view models and vice versa.
 *
 * @package Wambo\Cart\Service\Mapper
 */
class CartModelMapper
{
    /**
     * @var CartItemModelMapper
     */
    private $cartItemModelMapper;

    /**
     * Create a CartModelMapper instance.
     *
     * @param CartItemModelMapper $cartItemModelMapper A cart item model mapper
     */
    public function __construct(CartItemModelMapper $cartItemModelMapper)
    {
        $this->cartItemModelMapper = $cartItemModelMapper;
    }

    /**
     * Get a cart view model for the given Cart model.
     *
     * @param Cart $cartModel
     *
     * @return CartViewModel
     */
    public function getCartViewModel(Cart $cartModel): CartViewModel
    {
        $viewModel = new CartViewModel();
        $viewModel->cartIdentifier = $cartModel->getCartIdentifier();
        $viewModel->items = $this->getCartItemViewModels($cartModel->getItems());

        return $viewModel;
    }

    /**
     * Get cart item view models for the given cart item models
     *
     * @param CartItem[] $cartItems An array of cart item models
     *
     * @return CartItemViewModel[]
     */
    private function getCartItemViewModels(array $cartItems): array
    {
        $cartItemViewModels = [];
        foreach ($cartItems as $cartItem) {
            /** @var CartItem $cartItem */
            $cartItemViewModel = $this->cartItemModelMapper->getCartItemViewModel($cartItem);

            $cartItemViewModels[] = $cartItemViewModel;
        }

        return $cartItemViewModels;
    }
}