<?php
namespace Wambo\Frontend\Service\Mapper;

use Wambo\Frontend\Model\FrontendProductExtension;
use Wambo\Frontend\Model\Slug;
use Wambo\Product\Model\Exception\ProductException;
use Wambo\Product\Model\Product;
use Wambo\Product\Service\Mapper\ProductMapperInterface;

class FrontendProductMapper implements ProductMapperInterface
{
    const FIELD_SLUG = 'slug';
    const FIELD_TITLE = 'title';
    const FIELD_SUMMARY = 'summary';
    const FIELD_DESCRIPTION = 'description';
    const FIELD_IMAGE = 'image';

    /**
     * @var array $mandatoryFields A list of all mandatory fields of a Product
     */
    private $mandatoryFields = [self::FIELD_SLUG, self::FIELD_TITLE];

    public function isMappable(array $rawProductData) : bool
    {
        if( isset( $rawProductData[self::FIELD_SLUG] ) ){
            return true;
        }

        return false;
    }

    public function getProduct(Product $product, array $rawProductData) : Product
    {
        // check if all mandatory fields are present
        foreach ($this->mandatoryFields as $mandatoryField) {
            if (!array_key_exists($mandatoryField, $rawProductData)) {
                throw new ProductException("The field '$mandatoryField' is missing in the given product data");
            }
        }

        // slug
        $slug = new Slug($rawProductData[self::FIELD_SLUG]);

        // title
        $title = $rawProductData[self::FIELD_TITLE];
        $summery = $rawProductData[self::FIELD_SUMMARY];
        $description = $rawProductData[self::FIELD_DESCRIPTION];
        $image = isset($rawProductData[self::FIELD_IMAGE]) ? $rawProductData[self::FIELD_IMAGE] : '';

        $frontendProductExtension = new FrontendProductExtension($slug, $title, $summery, $description, $image);
        $product->addExtension('frontend', $frontendProductExtension);
        return $product;
    }

}