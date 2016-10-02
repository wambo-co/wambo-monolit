<?php

namespace Wambo\Core\Immutable;

/**
 * Class ImmutableTraitImpl just for PHPUnit Tests
 *
 * @package Wambo\Core\Immutable
 */
class ImmutableTraitImpl implements ImmutableInterface
{
    use ImmutableTrait;

    public function __construct()
    {
        $this->setConstructed();
    }
}