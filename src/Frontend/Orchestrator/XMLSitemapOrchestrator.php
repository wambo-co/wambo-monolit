<?php

namespace Wambo\Frontend\Orchestrator;

use Wambo\Catalog\ProductRepositoryInterface;
use Wambo\Frontend\ViewModel\XMLSitemap;
use Wambo\Frontend\ViewModel\XMLSitemapEntry;

class XMLSitemapOrchestrator
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * XMLSitemapOrchestrator constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getXMLSitemap(): XMLSitemap {

        $sitemap = new XMLSitemap();

        foreach ($this->productRepository->getProducts() as $product) {
            $entry = new XMLSitemapEntry();
            $entry->URI = $product->getSlug();
            $sitemap->Entries[] = $entry;

        }

        return $sitemap;
    }
}