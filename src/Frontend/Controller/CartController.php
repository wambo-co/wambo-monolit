<?php
namespace Wambo\Frontend\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class CartController
{

    /**
     * @var Twig $renderer
     */
    private $renderer;

    public function __construct(Twig $renderer)
    {
        $this->renderer = $renderer;
    }

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, 'cart.twig', [

        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function content(Request $request, Response $response)
    {
        $cart = json_decode($request->getParam('cart'));
    }

}