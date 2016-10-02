<?php

namespace Wambo\Core\ValueObject;

use Wambo\Core\Immutable\ImmutableInterface;

interface ValueObjectInterface extends ImmutableInterface
{
    public function getValue();
}