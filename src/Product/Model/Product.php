<?php
namespace Wambo\Product\Model;

use Wambo\Core\Model\SKU;

class Product
{

    /**
     * @var SKU
     */
    private $sku;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @var ProductExtensionInterface[]
     */
    private $productExtensions;

    /**
     * Product constructor.
     * @param SKU $sku
     * @param array $attributes
     */
    public function __construct(SKU $sku, array $attributes)
    {
        $this->sku = $sku;
        $this->attributes = $attributes;
    }

    /**
     * @return SKU
     */
    public function getSKU() : SKU
    {
        return $this->sku;
    }

    /**
     * @return array
     */
    public function getAttributes() : array
    {
        return $this->attributes;
    }

    /**
     * @return ProductExtensionInterface
     */
    public function getExtension(string $key) : ProductExtensionInterface
    {
        return $this->productExtensions[$key];
    }

    /**
     * @param ProductExtensionInterface $productExtension
     */
    public function addExtension(string $key, ProductExtensionInterface $productExtension)
    {
        $this->productExtensions[$key] = $productExtension;
    }
}