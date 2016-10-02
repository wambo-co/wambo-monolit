<?php

namespace Wambo\Core\Module;


use League\Flysystem\FileNotFoundException;
use Wambo\Core\Storage\StorageInterface;

/**
 * Class ModuleRepository
 * @package Wambo\Core\Module
 */
class ModuleRepository
{

    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var ModuleMapper
     */
    private $mapper;

    /**
     * ModuleRepository constructor.
     *
     * @param StorageInterface $storage
     * @param ModuleMapper $mapper
     */
    public function __construct(StorageInterface $storage, ModuleMapper $mapper)
    {
        $this->storage = $storage;
        $this->mapper = $mapper;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $modules = array();

        try {
            $modulesData = $this->storage->read();
        } catch (FileNotFoundException $e) {
            return [];
        }

        foreach ($modulesData as $moduleData)
        {
            $modules[] = $this->mapper->getModule($moduleData);
        }
        return $modules;
    }

    /**
     * @param Module $module
     */
    public function add(Module $module)
    {
        if ($this->has($module)) {
            return;
        }

        $allModules = $this->storage->read();
        $moduleData = $this->mapper->getData($module);
        array_push($allModules, $moduleData);

        $this->storage->write($allModules);
    }

    /**
     * @param Module $origModule
     * @return bool
     */
    public function has(Module $origModule) : bool
    {
        $allModules = $this->getAll();
        foreach ($allModules as $module) {
            if ($origModule->equals($module)) {
                return true;
            }
        }
        return false;
    }

}