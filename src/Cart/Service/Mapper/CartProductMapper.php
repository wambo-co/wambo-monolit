<?php
namespace Wambo\Cart\Service\Mapper;

use Money\Currency;
use Money\Money;
use Wambo\Cart\Model\CartProductExtension;
use Wambo\Frontend\Model\FrontendProductExtension;
use Wambo\Product\Model\Exception\ProductException;
use Wambo\Product\Model\Product;
use Wambo\Product\Service\Mapper\ProductMapperInterface;

class CartProductMapper implements ProductMapperInterface
{
    const FIELD_PRICE = 'price';

    /**
     * @var array $mandatoryFields A list of all mandatory fields of a Product
     */
    private $mandatoryFields = [self::FIELD_PRICE];

    public function isMappable(array $rawProductData) : bool
    {
        if( isset( $rawProductData[self::FIELD_PRICE] ) ){
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

        // price
        $price_raw = $rawProductData[self::FIELD_PRICE];
        $price = new Money($price_raw['amount'], new Currency($price_raw['currency']));

        $cartProductExtension = new CartProductExtension($price);
        $product->addExtension('cart', $cartProductExtension);
        return $product;
    }

}