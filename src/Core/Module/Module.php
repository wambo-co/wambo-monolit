<?php

namespace Wambo\Core\Module;

use Wambo\Core\Module\Exception\InvalidArgumentException;
use Wambo\Core\ValueObject\ValueObjectInterface;
use Wambo\Core\ValueObject\ValueObjectTrait;

/**
 * The Module Model is a Value Object. It is only represents by his values.
 *
 * @package Wambo\Core\Model
 */
class Module implements ValueObjectInterface
{
    use ValueObjectTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $class;


    /**
     * Module constructor.
     * @param string $name
     */
    public function __construct(string $name, string $version, string $class)
    {
        $this->validate($name, 'name');

        $this->name = $name;
        $this->version = $version;
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVersion() : string
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getClass() : string
    {
        return $this->class;
    }


    public function getValue()
    {
        // ToDo: is the use of ModuleMapper ok in this scope?
        $mapper = new ModuleMapper();
        return $mapper->getData($this);
    }

    /**
     * @param string $attr
     * @param string $attrName
     */
    private function validate(string $attr, string $attrName)
    {
        // empty
        if (strlen($attr) === 0) {
            throw new InvalidArgumentException(sprintf('%s can not be empty', $attrName));
        }

        // whitespaces
        if (preg_match('/\s/', $attr)) {
            throw new InvalidArgumentException(sprintf('illigal %s', $attrName));
        }
    }

}