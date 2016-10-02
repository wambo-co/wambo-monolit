<?php

namespace Wambo\Core\Model;

use Wambo\Core\Model\Exception\QtyException;
use Wambo\Core\ValueObject\ValueObjectInterface;

class Qty implements ValueObjectInterface
{
    private $qty;

    /**
     * Qty constructor.
     * @param float $qty
     * @throws QtyException
     */
    public function __construct(float $qty)
    {
        if($qty <= 0){
            throw new QtyException('Qty must be positiv');
        }

        $this->qty = $qty;
    }

    /**
     * @return float
     */
    public function getValue() : float
    {
        return $this->qty;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->qty;
    }
}