<?php
namespace Wambo\Frontend\Controller;

use Slim\Http\Response;
use Slim\Views\Twig;

class PlatformController
{
    /** @var Twig $renderer */
    private $renderer;

    /**
     * @param Twig $renderer
     */
    public function __construct(
        Twig $renderer
    ) {
        $this->renderer = $renderer;
    }

    /**
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function signUp(Response $response)
    {
        return $this->renderer->render($response, 'platform/signup.twig', [

        ]);

    }
}