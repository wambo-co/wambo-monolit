<?php
namespace Wambo\Core\Model;

use Money\Money;

/**
 * Interface TotalItemInterface
 * @package Wambo\Cart\Model
 */
interface TotalItemInterface
{
    /**
     * @return Money
     */
    public function getAmount() : Money;

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @return int
     */
    public function getSort() : int;
}