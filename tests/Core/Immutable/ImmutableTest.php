<?php

namespace Wambo\Core\Immutable;

use PHPUnit\Framework\TestCase;

/**
 * Class ImmutableTest
 * @package Wambo\Core\Immutable
 */
class ImmutableTest extends TestCase
{
    /**
     * test Immutable Class can be created via constructor
     *
     * @test
     */
    public function testConstructor()
    {
        // arrange
        $obj = new ImmutableTraitImpl();
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
        $obj = new ImmutableTraitImpl();

        // act
        $obj->__construct();
    }

    /**
     * @test
     * @expectedException \Wambo\Core\Immutable\Exception\ImmutableException
     */
    public function testMagicSetMethod()
    {
        // arrange
        $obj = new ImmutableTraitImpl();

        // act
        $obj->__set('test', 'test value');
    }
}