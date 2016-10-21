<?php
namespace Wambo\Core;

use DI\Container;
use DI\ContainerBuilder;

class App extends \DI\Bridge\Slim\App
{

    private $bootstrapFilePath;

    public function __construct(string $bootstrapFilePath)
    {
        $this->bootstrapFilePath = $bootstrapFilePath;

        parent::__construct();
    }

    public function getContainer() : Container
    {
        return parent::getContainer();
    }

    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions($this->bootstrapFilePath);
    }


}