<?php

namespace Wambo\Core\Module;

use PHPUnit\Framework\TestCase;

/**
 * Class ModuleTest
 * @package Wambo\Core\Module
 */
class ModuleTest extends TestCase
{

    /**
     * @test
     */
    public function testConstructor()
    {
        // arrange
        $module = new Module('Test', 'v2.14.3', 'Wambo\\Test\\Boostrap');

        // assert
        $this->assertInstanceOf('Wambo\Core\Module\Module', $module);
    }

    /**
     * @test
     * @expectedException \Wambo\Core\Module\Exception\InvalidArgumentException
     */
    public function testInvalidArgumentsInConstructor()
    {
        // ToDo: more test with invalid namespaces and module names

        // arrange
        new Module('', '', '');
    }

    /**
     * @test
     */
    public function testTowModulesAreEqual()
    {
        // arrange
        $moduleA = new Module('Test', 'v4.32.3', 'Wambo\\Test\\Boostrap');
        $moduleB = new Module('Test', 'v4.32.3', 'Wambo\\Test\\Boostrap');

        // act
        $isEqual = $moduleA->equals($moduleB);

        // assert
        $this->assertTrue($isEqual, true);
    }

}
