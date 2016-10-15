<?php
namespace Wambo\Product\Service\Mapper;

use Wambo\Core\Model\SKU;
use Wambo\Product\Model\Exception\ProductException;
use Wambo\Product\Model\Product;

class ProductMapper
{
    const FIELD_SKU = "sku";

    /**
     * @var array $mandatoryFields A list of all mandatory fields of a Product
     */
    private $mandatoryFields = [self::FIELD_SKU];

    /**
     * @param array $rawProductData
     * @return bool
     */
    public function isMappable(array $rawProductData) : bool
    {
        // can not map without sku
        if( ! isset( $rawProductData[self::FIELD_SKU] ) ){
            return false;
        }

        return true;
    }

    /**
     * @param array $rawProductData
     * @return Product
     * @throws ProductException
     */
    public function getProduct(array $rawProductData) : Product
    {
        // check if all mandatory fields are present
        foreach ($this->mandatoryFields as $mandatoryField) {
            if (!array_key_exists($mandatoryField, $rawProductData)) {
                throw new ProductException("The field '$mandatoryField' is missing in the given product data");
            }
        }

        // sku
        $sku = new SKU($rawProductData[self::FIELD_SKU]);

        $product = new Product($sku, $rawProductData);
        return $product;
    }
}