<?php
namespace Wambo\Core\Model\Exception;

/**
 * Class SKUException handles SKU-related errors.
 */
class SKUException extends \Exception
{
    /**
     * SKUException constructor.
     *
     * @param string     $message        An error message
     * @param \Exception $innerException The underlying exception (optional)
     */
    public function __construct($message, $innerException = null)
    {
        parent::__construct($message, 500, $innerException);
    }
}