<?php

namespace Wambo\Core\Module;

use PHPUnit\Framework\TestCase;
use Wambo\Core\Module\Exception\InvalidArgumentException;

class ModuleMapperTest extends TestCase
{

    public function testCreate_Success()
    {
        // arrange
        $mapper = new ModuleMapper();
        $data = array(
            'name' => 'Test',
            'version' => 'v0.3.1',
            'class' => 'Wambo\\Test\\Bootstrap'
        );

        // act
        $module = $mapper->getModule($data);

        //assert
        $this->assertInstanceOf('\Wambo\Core\Module\Module', $module);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function testCreate_Fail()
    {
        //arrange
        $mapper = new ModuleMapper();
        $data = array();

        //act
        $mapper->getModule($data);

    }
}