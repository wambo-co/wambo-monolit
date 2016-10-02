<?php

namespace Wambo\Cart\Service\Storage;

use Wambo\Cart\Exception\CartNotFoundException;
use Wambo\Cart\Model\Cart;
use Wambo\Cart\Model\CartItem;
use Wambo\Core\Storage\StorageInterface;

/**
 * Class CartRepository provides read/write access to Carts.
 *
 * @package Wambo\Cart\Storage
 */
class CartRepository implements CartRepositoryInterface
{
    /**
     * @var StorageInterface
     */
    private $cartStorage;

    /**
     * Create a new CartRepository instance.
     *
     * @param StorageInterface $cartStorage A cart storage
     */
    public function __construct(StorageInterface $cartStorage)
    {
        $this->cartStorage = $cartStorage;
    }

    /**
     * Get the cart with the given identifier
     *
     * @param string $cartIdentifier A cart identifier
     *
     * @return Cart
     *
     * @throws CartNotFoundException If no cart with found for the given cart identifier
     */
    public function getCart(string $cartIdentifier): Cart
    {
        $cartsById = $this->cartStorage->read();
        if (isset($cartsById[$cartIdentifier]) == false) {
            throw new CartNotFoundException("The cart with the identifier \"$cartIdentifier\" was not found");
        }

        $cartModel = $this->getCartModel($cartsById[$cartIdentifier]);
        return $cartModel;
    }

    /**
     * Save the given cart.
     *
     * @param Cart $cart
     */
    public function saveCart(Cart $cart)
    {
        $cartsById = $this->cartStorage->read();
        $cartData = $this->getCartData($cart);
        $cartsById[$cart->getCartIdentifier()] = $cartData;
        $this->cartStorage->write($cartsById);
    }

    /**
     * Get an array of Cart data for the given Cart model.
     *
     * @param Cart $cartModel A Cart model
     *
     * @return array
     */
    private function getCartData(Cart $cartModel): array
    {
        $cartItemData = [];
        foreach ($cartModel->getItems() as $cartItem) {
            $cartItemData[] = $this->getCartItemData($cartItem);
        }

        return [
            "cartIdentifier" => $cartModel->getCartIdentifier(),
            "cartItems" => $cartItemData
        ];
    }

    /**
     * Get an array of cart item data for the given CartItem model.
     *
     * @param CartItem $cartItem A CartItem model
     *
     * @return array
     */
    private function getCartItemData(CartItem $cartItem): array
    {
        return [
            "sku" => $cartItem->getSku()
        ];
    }

    /**
     * Get a Cart model from unstructured cart data
     *
     * @param array $unstructuredCartData An unstructured array of carts
     *
     * @return Cart
     */
    private function getCartModel(array $unstructuredCartData): Cart
    {
        $cartIdentifier = $unstructuredCartData["cartIdentifier"];
        $cartItems = $unstructuredCartData["cartItems"];

        $cartItemModels = [];
        foreach ($cartItems as $cartItemData) {
            /** @var array $cartItemData */
            $cartItem = $this->getCartItemModel($cartItemData);

            $cartItemModels[] = $cartItem;
        }

        return new Cart($cartIdentifier, $cartItems);
    }

    /**
     * Get a CartIem model from the given unstructured array of cart item data
     *
     * @param array $unstructuredCartItemData An unstructured array cart item data
     *
     * @return CartItem
     */
    private function getCartItemModel(array $unstructuredCartItemData): CartItem
    {
        $sku = $unstructuredCartItemData["sku"];
        return new CartItem($sku);
    }
}