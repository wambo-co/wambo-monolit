<?php
namespace Wambo\Catalog\Model;

use Wambo\Core\Model\SKU;

/**
 * Class Product represents a single catalog item or product.
 *
 * @package Wambo\Catalog
 */
class Product
{
    /**
     * @var SKU
     */
    private $sku;

    /**
     * @var PriceInterface
     */
    private $price;

    /**
     * @var Slug
     */
    private $slug;

    /**
     * @var Content
     */
    private $content;


    /**
     * Creates a new Product basic class instance.
     *
     * @param SKU     $sku     A unique identifier for the product (e.g. "fancy-short-1")
     * @param PriceInterface $price
     * @param Slug    $slug    A human-readable, descriptive URL fragment for the product (e.g.
     *                         "fancy-t-shirt-1-with-ice-cream-pooping-unicorn")
     * @param Content $content A product content model
     *
     */
    public function __construct(SKU $sku, PriceInterface $price, Slug $slug, Content $content)
    {
        $this->sku = $sku;
        $this->price = $price;
        $this->slug = $slug;
        $this->content = $content;
    }

    /**
     * Get the unique identifier for the product (e.g. "fancy-short-1")
     *
     * @return SKU
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Get the human-readable, descriptive URL fragment for the product (e.g.
     *                        "fancy-t-shirt-1-with-ice-cream-pooping-unicorn")
     *
     * @return Slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the content of the product
     *
     * @return Content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return PriceInterface
     */
    public function getPrice() : PriceInterface
    {
        return $this->price;
    }

}