<?php

namespace Wambo\Core\Storage;

/**
 * Class JSONDecoderTest
 *
 * @package Wambo\Core\Storage
 */
class JSONDecoderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function testGetData()
    {
        // arrange
        $jsonDecoder = new JSONDecoder();
        $json = <<<JSON
{
  "foo": "bar",
  "key": "value",
  "multi": {"is": true}
}
JSON;
        $data = array(
            'foo' => 'bar',
            'key' => 'value',
            'multi' => array('is' => true)
        );

        // act
        $decodedJSONData = $jsonDecoder->getData($json);

        // assert
        $this->assertEquals($decodedJSONData, $data);
    }

    /**
     * Test broken json
     *
     * @test
     * @expectedException \Wambo\Core\Storage\Exception\RuntimeException
     */
    public function testGetData_InvalidSyntax()
    {
        // arrange
        $jsonDecoder = new JSONDecoder();
        $json = <<<JSON
{
  "foo", "bar"
}
JSON;

        // act
        $jsonDecoder->getData($json);

    }
}
