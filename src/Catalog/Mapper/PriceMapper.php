<?php
namespace Wambo\Catalog\Mapper;


use Money\Currency;
use Money\Money;
use Wambo\Catalog\Exception\PriceException;
use Wambo\Catalog\Model\Price;
use Wambo\Catalog\Model\PriceInterface;

/**
 * Class PriceMapper
 * @package Wambo\Catalog\Mapper
 */
class PriceMapper
{
    const FIELD_AMOUNT = "amount";
    const FIELD_CURRENCY = "currency";

    private $mandatoryFields = [self::FIELD_AMOUNT, self::FIELD_CURRENCY];

    /**
     * @param array $priceData
     *
     * @return PriceInterface
     * @throws PriceException
     */
    public function getPrice(array $priceData) : PriceInterface
    {
        // check if all mandatory fields are present
        foreach ($this->mandatoryFields as $mandatoryField) {
            if (!array_key_exists($mandatoryField, $priceData)) {
                throw new PriceException("The field '$mandatoryField' is missing in the given price data");
            }
        }

        try {
            $money = new Money($priceData[self::FIELD_AMOUNT], new Currency($priceData[self::FIELD_CURRENCY]));
            $price = new Price($money);
            return $price;
        } catch (\Exception $priceException) {
            throw new PriceException(sprintf("Failed to create a price model from the given data: %s",
                $priceException->getMessage()), $priceException);
        }
    }
}