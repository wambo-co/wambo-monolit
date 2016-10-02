<?php

namespace Wambo\Core\Module;

use InvalidArgumentException;

class ModuleMapper
{
    /**
     * @param $data
     * @return Module
     */
    public function getModule($data) : Module
    {
        // ToDo: may static is better?
        if (!array_key_exists('name', $data) ||
            !array_key_exists('version', $data) ||
            !array_key_exists('class', $data)
        ) {
            throw new InvalidArgumentException('can not create Module. Not all nessesary data provided');
        }

        return new Module($data['name'], $data['version'], $data['class']);
    }

    /**
     * @param Module $module
     * @return array
     */
    public function getData(Module $module)
    {
        // ToDo: may static is better?
        $data = array(
            'name' => $module->getName(),
            'version' => $module->getVersion(),
            'class' => $module->getClass()
        );

        return $data;
    }
}