<?php

namespace Wambo\Core\ValueObject;

use Wambo\Core\Immutable\ImmutableTrait;
use Wambo\Core\ValueObject\Exception\ValueObjectException;

/**
 * Class ValueObjectTrait
 *
 * @package Wambo\Core\ValueObject
 */
trait ValueObjectTrait
{
    use ImmutableTrait;
    /**
     * Disable clone function to prevent clone Value Objects
     */
    final public function __clone()
    {
        throw new ValueObjectException('ValueObjects are not cloneable');
    }
    /**
     * @param ValueObjectInterface $obj
     * @return bool
     */
    public function equals(ValueObjectInterface $obj)
    {
        if (get_called_class() !== get_class($obj)) {
            return false;
        }

        /** @var ValueObjectInterface $this */
        return $this->getValue() === $obj->getValue();
    }
}