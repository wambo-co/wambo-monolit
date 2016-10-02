<?php

namespace Wambo\Core\Model;

use Money\Money;

/**
 * Class TotalItem
 * @package Wambo\Cart\Model
 */
class TotalItem implements TotalItemInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var int
     */
    private $sort;

    /**
     * Total constructor.
     * @param string $name
     * @param Money $amount
     * @param int $sort
     */
    public function __construct(string $name, Money $amount, int $sort)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->sort = $sort;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSort() : int
    {
        return $this->sort;
    }

    /**
     * @return Money
     */
    public function getAmount() : Money
    {
        return $this->amount;
    }
}