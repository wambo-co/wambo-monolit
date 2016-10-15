<?php
namespace Wambo\Core;
use DI\ContainerBuilder;
use Wambo\Core\Module\Module;
use Wambo\Core\Module\ModuleRepository;

/**
 * Class App
 * @package Wambo\Core
 */
class App extends \DI\Bridge\Slim\App
{
    /**
     * @var string
     */
    private $bootstrapFilePath;

    /**
     * App constructor.
     *
     * @param string $bootstrapFilePath
     */
    public function __construct(string $bootstrapFilePath)
    {
        $this->bootstrapFilePath = $bootstrapFilePath;

        parent::__construct();
    }

    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions($this->bootstrapFilePath);
    }


}