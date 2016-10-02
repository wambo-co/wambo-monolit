<?php
namespace Wambo\Core\Model;

use PHPUnit\Framework\TestCase;

class QtyTest extends TestCase
{
    public function testUseOfQtyModel()
    {
        // arrange

        // act
        $qty = new Qty(2);
        $qty2 = new Qty(3.14259);
        $qty3 = new Qty(0xFF);

        // assert
        $this->assertEquals($qty->getValue(), 2.00);
        $this->assertEquals($qty2->getValue(), 3.14259);
        $this->assertEquals($qty3->getValue(), 255);
    }

    /**
     * @test
     * @expectedException \TypeError
     */
    public function testStringArgument()
    {
        // act
        $qty = new Qty("two");
    }

    /**
     * @test
     * @expectedException \Wambo\Core\Model\Exception\QtyException
     */
    public function testNegativQty()
    {
        // act
        $qty = new Qty(-2);

    }
}