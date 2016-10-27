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
     * @var ProductExtensionInterface[]
     */
    private $productExtensions;

    /**
     * Product constructor.
     * @param SKU $sku
     */
    public function __construct(SKU $sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return SKU
     */
    public function getSKU() : SKU
    {
        return $this->sku;
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