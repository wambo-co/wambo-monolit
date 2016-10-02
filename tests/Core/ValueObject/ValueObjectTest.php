<?php

namespace Wambo\Core\ValueObject;

use PHPUnit\Framework\TestCase;
use Wambo\Core\ValueObject\Exception\ValueObjectException;

/**
 * Class ValueObjectTest
 * @package Wambo\Core\ValueObject
 */
class ValueObjectTest extends TestCase
{
    public function testConstructor()
    {
        new ValueObjectImpl('a');
    }

    /**
     * test Immutable Class can´t use __constructor again
     *
     * @test
     * @expectedException \Wambo\Core\Immutable\Exception\ImmutableException
     */
    public function testConstructor_asFunction()
    {
        // arrange
        $obj = new ValueObjectImpl('a');

        // act
        $obj->__construct('b');
    }

    /**
     * @test
     * @expectedException \Wambo\Core\Immutable\Exception\ImmutableException
     */
    public function testMagicSetMethod()
    {
        // arrange
        $obj = new ValueObjectImpl('a');

        // act
        $obj->__set('test', 'test value');
    }

    /**
     * @test
     * @expectedException \Wambo\Core\ValueObject\Exception\ValueObjectException
     */
    public function testClone()
    {
        // arrange
        $obj = new ValueObjectImpl('a');

        $objB = clone $obj;
    }

    public function testEquals()
    {
        // arrange
        $obj_a = new ValueObjectImpl('a');
        $obj_b = new ValueObjectImpl('a');

        // act
        $isEquals_func = $obj_a->equals($obj_b);
        $isEquals_doubleOperator = $obj_a == $obj_b;

        // assert
        $this->assertTrue($isEquals_func);
        $this->assertTrue($isEquals_doubleOperator);
    }
}