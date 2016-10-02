<?php

namespace Wambo\Cart\Orchestrator;

use Wambo\Cart\Service\CartFactory;
use Wambo\Cart\Service\Mapper\CartModelMapper;
use Wambo\Cart\Service\Storage\CartRepositoryInterface;
use Wambo\Cart\ViewModel\CartViewModel;

class CartOrchestrator
{
    /**
     * @var CartRepositoryInterface
     */
    private $cartRepository;
    /**
     * @var CartFactory
     */
    private $cartFactory;
    /**
     * @var CartModelMapper
     */
    private $cartModelMapper;

    /**
     * Create a new CartController instance.
     *
     * @param \Wambo\Cart\Service\Storage\CartRepositoryInterface $cartRepository  An instance of the cart repository.
     * @param CartFactory                                         $cartFactory     A cart factory
     * @param CartModelMapper                                     $cartModelMapper A mapper between cart models and cart view models
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        CartFactory $cartFactory,
        CartModelMapper $cartModelMapper
    ) {
        $this->cartRepository = $cartRepository;
        $this->cartFactory = $cartFactory;
        $this->cartModelMapper = $cartModelMapper;
    }

    /**
     * Create a new cart
     *
     * @return CartViewModel
     */
    public function createCart(): CartViewModel
    {
        $cart = $this->cartFactory->createCart();
        $this->cartRepository->saveCart($cart);

        $cartViewModel = $this->cartModelMapper->getCartViewModel($cart);
        return $cartViewModel;
    }

    /**
     * Get the cart with the specified cart identifier.
     *
     * @param string $cartIdentifier A cart identifier
     *
     * @return CartViewModel
     */
    public function getCart(string $cartIdentifier)
    {
        $cart = $this->cartRepository->getCart($cartIdentifier);
        if (is_null($cart)) {
            return null;
        }

        $cartViewModel = $this->cartModelMapper->getCartViewModel($cart);
        return $cartViewModel;
    }
}