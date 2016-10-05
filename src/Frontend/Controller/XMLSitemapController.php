<?php

namespace Wambo\Frontend\Controller;

use Slim\Http\Response;
use Slim\Views\Twig;
use Wambo\Catalog\ProductRepositoryInterface;

class XMLSitemapController
{
    /**
     * @var Twig
     */
    private $renderer;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository, Twig $renderer)
    {
        $this->renderer = $renderer;
        $this->productRepository = $productRepository;
    }

    public function sitemap(Response $response)
    {
        $response = $response->withHeader("Content-Type", "text/xml");
        return $this->renderer->render($response, 'xmlsitemap.twig', [
            "products" => $this->productRepository->getProducts(),
        ]);
    }
}