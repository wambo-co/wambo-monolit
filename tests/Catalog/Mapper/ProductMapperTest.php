<?php
use Money\Money;
use Wambo\Catalog\Mapper\ContentMapper;
use Wambo\Catalog\Mapper\PriceMapper;
use Wambo\Catalog\Mapper\ProductMapper;
use Wambo\Catalog\Model\Content;
use Wambo\Catalog\Model\Price;

/**
 * Class ProductMapperTest tests the Wambo\Catalog\Mapper\ProductMapper class.
 */
class ProductMapperTest extends PHPUnit_Framework_TestCase
{
    /**
     * If all required fields are given and the validation passes a product should be returned
     *
     * @test
     */
    public function getProduct_AllRequiredFieldsPresent_ValidationPasses_ProductIsReturned()
    {
        // arrange
        $contentMapperMock = $this->createMock(ContentMapper::class);
        $contentMapperMock->method("getContent")->willReturn(new Content("Title", "Summary", "..."));

        $priceMapperMock = $this->createMock(PriceMapper::class);
        $priceMapperMock->method("getPrice")->willReturn(new Price(Money::EUR(300)));

        /** @var ContentMapper $contentMapperMock */
        /** @var PriceMapper $priceMapperMock */
        $productMapper = new ProductMapper($contentMapperMock, $priceMapperMock);

        $productData = array(
            "sku" => "a-product",
            "slug" => "A-Product",
            "title" => "Super fancy product",
            "summary" => "A super fancy product",
            "price" => array(
                "amount" => 123,
                "currency" => "EUR"
            )
        );

        // act
        $product = $productMapper->getProduct($productData);

        // assert
        $this->assertNotNull($product, "getProduct() should have returned a product");
    }

    /**
     * If given product data is missing one of the mandatory fields and exception should be thrown.
     *
     * @param array $productData Unstructured product data
     *
     * @test
     *
     * @expectedException \Wambo\Catalog\Exception\ProductException
     * @expectedExceptionMessageRegExp /The field '\w+' is missing in the given product data/
     * @dataProvider                   getProductDataWithMissingAttribute
     */
    public function getProduct_RequiredFieldMissing_ProductExceptionIsThrown(array $productData)
    {
        // arrange
        $contentMapperMock = $this->createMock(ContentMapper::class);
        $contentMapperMock->method("getContent")->willReturn(new Content("Title", "Summary", "..."));

        $priceMapperMock = $this->createMock(PriceMapper::class);
        $priceMapperMock->method("getPrice")->willReturn(new Price(Money::EUR(300)));

        /** @var ContentMapper $contentMapperMock */
        /** @var PriceMapper $priceMapperMock */
        $productMapper = new ProductMapper($contentMapperMock, $priceMapperMock);


        // act
        $productMapper->getProduct($productData);
    }

    /**
     * If the SKU validation fails and exception should be thrown
     *
     * @test
     * @expectedException Wambo\Catalog\Exception\ProductException
     */
    public function getProduct_AllRequiredFieldsPresent_SkuValidationFails_ProductIsReturned()
    {
        // arrange
        $contentMapperMock = $this->createMock(ContentMapper::class);
        $contentMapperMock->method("getContent")->willReturn(new Content("Title", "Summary", "..."));

        $priceMapperMock = $this->createMock(PriceMapper::class);
        $priceMapperMock->method("getPrice")->willReturn(new Price(Money::EUR(300)));

        /** @var ContentMapper $contentMapperMock */
        /** @var PriceMapper $priceMapperMock */
        $productMapper = new ProductMapper($contentMapperMock, $priceMapperMock);


        $productData = array(
            "sku" => "a",
            "slug" => "A-Product",
            "title" => "Super fancy product",
            "summary" => "A super fancy product",
        );

        // act
        $productMapper->getProduct($productData);
    }

    /**
     * If the Slug validation fails and exception should be thrown
     *
     * @test
     * @expectedException Wambo\Catalog\Exception\ProductException
     */
    public function getProduct_AllRequiredFieldsPresent_SlugValidationFails_ProductIsReturned()
    {
        // arrange
        $contentMapperMock = $this->createMock(ContentMapper::class);
        $contentMapperMock->method("getContent")->willReturn(new Content("Title", "Summary", "..."));

        $priceMapperMock = $this->createMock(PriceMapper::class);
        $priceMapperMock->method("getPrice")->willReturn(new Price(Money::EUR(300)));

        /** @var ContentMapper $contentMapperMock */
        /** @var PriceMapper $priceMapperMock */
        $productMapper = new ProductMapper($contentMapperMock, $priceMapperMock);

        $productData = array(
            "sku" => "a-product",
            "slug" => "A/Product",
            "title" => "Super fancy product",
            "summary" => "A super fancy product",
        );

        // act
        $productMapper->getProduct($productData);
    }

    /**
     * Get product data with one or more missing attributes.
     */
    public static function getProductDataWithMissingAttribute()
    {
        return [

            // empty
            [
                []
            ],

            // wrong casing
            [
                [
                    "SKU" => "a-product",
                    "SLUG" => "A-Product",
                ]
            ],

            // slug missing
            [
                [
                    "sku" => "a-product",
                ]
            ],

            // sku missing
            [
                [
                    "slug" => "A-Product",
                ]
            ]

        ];
    }
}
