<?php

namespace Wambo\Cart\Exception;

/**
 * Class CartNotFoundException is used when a given cart was not found.
 *
 * @package Wambo\Cart\Exception
 */
class CartNotFoundException extends \Exception
{
    /**
     * Creates a new instance of the CartNotFoundException class.
     *
     * @param string $message An error message
     */
    public function __construct($message)
    {
        parent::__construct($message, 404);
    }
}