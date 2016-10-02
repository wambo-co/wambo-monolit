<?php

namespace Wambo\Core\Module;

use League\Flysystem\Filesystem;
use League\Flysystem\Memory\MemoryAdapter;
use PHPUnit\Framework\TestCase;
use Wambo\Core\Storage\StorageInterface;

class ModuleRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function testConstructor()
    {
        // arrange

        /** @var StorageInterface $storage */
        $storage = $this->createMock(StorageInterface::class);

        /** @var ModuleMapper $mapper */
        $mapper = $this->createMock(ModuleMapper::class);

        new ModuleRepository($storage, $mapper);
    }

    /**
     * @test
     */
    public function testAdd()
    {
        // arrange
        $filesystem = new Filesystem(new MemoryAdapter());
        $storage = new JSONModuleStorage($filesystem, 'modules.json');
        $mapper = new ModuleMapper();


        $repo = new ModuleRepository($storage, $mapper);
        $module = new Module('Test', 'v3.3.2', 'Wambo\\Test\\Boostrap');

        // act
        $repo->add($module);
        $allModules = $repo->getAll();

        // assert
        $this->assertEquals($module, array_pop($allModules));
    }

    /**
     * @test
     */
    public function testaddTwoEqualObjects()
    {
        // arrange
        $filesystem = new Filesystem(new MemoryAdapter());
        $storage = new JSONModuleStorage($filesystem, 'modules.json');
        $mapper = new ModuleMapper();


        $repo = new ModuleRepository($storage, $mapper);
        $module = new Module('Test', 'v3.4.3', 'Wambo\\Test\\Boostrap');

        // act
        $repo->add($module);
        $repo->add($module);
        $allModules = $repo->getAll();

        // assert
        $this->assertTrue(count($allModules) == 1);
        $this->assertEquals($module, array_pop($allModules));
    }
}