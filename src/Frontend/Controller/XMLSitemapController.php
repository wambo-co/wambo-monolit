<?php

namespace Wambo\Frontend\Controller;

use Slim\Http\Response;
use Slim\Views\Twig;
use Wambo\Frontend\Orchestrator\XMLSitemapOrchestrator;

class XMLSitemapController
{
    /**
     * @var XMLSitemapOrchestrator
     */
    private $XMLSitemapOrchestrator;
    /**
     * @var Twig
     */
    private $renderer;

    public function __construct(XMLSitemapOrchestrator $XMLSitemapOrchestrator, Twig $renderer)
    {
        $this->XMLSitemapOrchestrator = $XMLSitemapOrchestrator;
        $this->renderer = $renderer;
    }

    public function sitemap(Response $response)
    {
        $response = $response->withHeader("Content-Type", "text/xml");
        $sitemap = $this->XMLSitemapOrchestrator->getXMLSitemap();
        return $this->renderer->render($response, 'xmlsitemap.twig', [
            "sitemap" => $sitemap,
        ]);
    }
}