<?php

namespace Wambo\Product\Controller;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;
use Wambo\Frontend\Controller\ErrorController;
use Wambo\Frontend\Model\Slug;
use Wambo\Product\Exception\ProductNotFoundException;
use Wambo\Product\Service\Repository\ProductRepositoryInterface;

/**
 * Class CatalogController contains the frontend controller actions for browsing the product catalog.
 *
 * @package Wambo\Frontend\Controller
 */
class ProductController
{
    /** @var Twig $renderer */
    private $renderer;

    /** @var ErrorController $errorController */
    private $errorController;

    /** @var ProductRepositoryInterface */
    private $productRepository;

    /**
     * Creates a new instance of the CatalogController class.
     *
     * @param ErrorController            $errorController
     * @param Twig                       $renderer
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        ErrorController $errorController,
        Twig $renderer,
        ProductRepositoryInterface $productRepository
    ) {
        $this->errorController = $errorController;
        $this->renderer = $renderer;
        $this->productRepository = $productRepository;
    }

    /**
     * Render the catalog overview pages with all products on one page
     *
     * @param Response $response The response object
     *
     * @return ResponseInterface
     */
    public function overview(Response $response)
    {
        return $this->renderer->render($response, 'overview.twig', [
            "page" => [
                "title" => "Overview",
                "description" => "Product overview",
                "url" => "/",
            ],
            "products" => $this->productRepository->getProducts(),
        ]);

    }

    /**
     * Render the product details page.
     *
     * @param string   $slug
     * @param Request  $request
     * @param Response $response The response object
     *
     * @return ResponseInterface
     */
    public function productDetails(string $slug, Request $request, Response $response)
    {

        try {

            $product = $this->productRepository->getProductBySlug(new Slug($slug));

            $viewModel = [
                "page" => [
                    "title" => "Overview",
                    "description" => "Product overview",
                    "url" => "/",
                ],
                "product" => $product
            ];

            return $this->renderer->render($response, 'product.twig', $viewModel);

        } catch (ProductNotFoundException $productNotFoundException) {
            return $this->errorController->error404($request, $response);
        }

    }


}