<?php
namespace Wambo\Frontend\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;
use Wambo\Frontend\Service\HandleRegistration;

class PlatformController
{
    /** @var Twig $renderer */
    private $renderer;
    /**
     * @var HandleRegistration
     */
    private $handleRegistration;

    /**
     * @param Twig               $renderer
     * @param HandleRegistration $handleRegistration
     */
    public function __construct(Twig $renderer, HandleRegistration $handleRegistration)
    {
        $this->renderer = $renderer;
        $this->handleRegistration = $handleRegistration;
    }

    public function home(Response $response)
    {
        return $this->renderer->render($response, 'platform/home.twig', [

        ]);
    }

    /**
     * @param Response $response
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function signUp(Request $request, Response $response)
    {
        if ($request->isPost()) {
            return $response->withRedirect('/admin/product/add');
        }
        return $this->renderer->render($response, 'platform/signup.twig', [

        ]);
    }

    /**
     * Wambo Handle Reservation
     *
     * @param Request  $request
     * @param Response $response
     */
    public function reservation(Request $request, Response $response)
    {
        return $this->renderer->render($response, 'platform/reservation.twig', []);
    }

    /**
     * Reserve a Wambo handle
     *
     * @param Request  $request
     * @param Response $response
     */
    public function reserve(Request $request, Response $response)
    {
        if (!$request->isPost()) {
            return $response->withStatus(400, "Bad request");
        }

        $emailAddress = $request->getParam("email");
        $handle = $request->getParam("handle");

        try {
            $this->handleRegistration->register($emailAddress, $handle);
        } catch (\Exception $exception) {
            return $response->withRedirect("reservation");
        }

        return $response->withRedirect("reservation-success");
    }
}