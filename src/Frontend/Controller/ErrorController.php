<?php

namespace Wambo\Frontend\Controller;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;
use Wambo\Frontend\Orchestrator\PageOrchestrator;

/**
 * Class ErrorController container the frontend controller actions for HTTP errors
 *
 * @package Wambo\Frontend\Controller
 */
class ErrorController
{
    /** @var Twig $renderer */
    private $renderer;

    /**
     * Creates a new instance of the ErrorController class.
     *
     * @param Twig             $renderer
     */
    public function __construct(Twig $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Render an 404 error page.
     *
     * @param Request  $request  The request object
     * @param Response $response The response object
     *
     * @return ResponseInterface
     */
    public function error404(Request $request, Response $response)
    {
        $viewModel = [
            "page" => [
                "title" => "Page not found"
            ]
        ];

        return $this->renderer->render($response->withStatus(404), 'error.twig', $viewModel);
    }
}