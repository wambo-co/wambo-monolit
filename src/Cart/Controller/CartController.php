<?php

namespace Wambo\Cart\Controller;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Wambo\Cart\Orchestrator\CartOrchestrator;

/**
 * Class CartController provides API methods for common shopping cart operations.
 *
 * @package Wambo\Cart\Controller
 */
class CartController
{
    /**
     * @var CartOrchestrator
     */
    private $cartOrchestrator;

    /**
     * Create a new CartController instance.
     *
     * @param CartOrchestrator $cartOrchestrator
     *
     */
    public function __construct(CartOrchestrator $cartOrchestrator)
    {
        $this->cartOrchestrator = $cartOrchestrator;
    }

    /**
     * Create a new cart
     *
     * @param Request  $request
     * @param Response $response
     *
     * @return ResponseInterface
     */
    public function createCart(Request $request, Response $response)
    {
        $cartIdentifier = $this->getCartIdentifierFromCookieParams($request->getCookieParams());
        if (strlen($cartIdentifier) != 0) {

            if ($this->cartOrchestrator->getCart($cartIdentifier) != null) {

                // Bad request
                return $response->withStatus(400, "You already have a cart");
            }

        }

        $cart = $this->cartOrchestrator->createCart();
        return $response->withJson($cart);
    }

    /**
     * Get the cart with the specified cart identifier.
     *
     * @param Request  $request
     * @param Response $response
     *
     * @return ResponseInterface
     */
    public function getCart(Request $request, Response $response)
    {
        $cartIdentifier = $this->getCartIdentifierFromCookieParams($request->getCookieParams());
        if (strlen($cartIdentifier) == 0) {
            // Bad request
            return $response->withStatus(400, "No cart identifier supplied");
        }

        $cart = $this->cartOrchestrator->getCart($cartIdentifier);
        if (is_null($cart)) {
            // Not found
            return $response->withStatus(404, "Cart not found");
        }

        return $response->withJson($cart);
    }

    /**
     * Get the cart identifier from the given cookie parameters
     *
     * @param array $cookieParameters An array of cookie parameters
     *
     * @return string
     */
    private function getCartIdentifierFromCookieParams(array $cookieParameters): string
    {
        if (isset($cookieParameters["cart"]) === false) {
            return "";
        }

        $cartIdentifier = $cookieParameters["cart"];
        return $cartIdentifier;
    }
}