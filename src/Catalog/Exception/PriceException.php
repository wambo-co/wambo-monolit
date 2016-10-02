<?php
namespace Wambo\Catalog\Exception;

use \Exception;

class PriceException extends Exception
{
    public function __construct($message, $innerException = null)
    {
        parent::__construct($message, 500, $innerException);
    }
}