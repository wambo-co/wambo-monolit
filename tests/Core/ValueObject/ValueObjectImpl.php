<?php

namespace Wambo\Core\ValueObject;
/**
 * Class ValueObjectImpl just for PHPUnit tests
 *
 * @package Wambo\Core\ValueObject
 */
class ValueObjectImpl implements ValueObjectInterface
{
    use ValueObjectTrait;

    private $value;

    public function __construct($value)
    {
        $this->value = $value;
        $this->setConstructed();
    }

    public function getValue()
    {
        return $this->value;
    }
}