<?php

namespace App\Services\Carrier\Rules;

/**
 *
 */
abstract class Rule
{

    /**
     * @param  int|float  $value
     *
     * @return bool
     */
    abstract function match(int|float $value): bool;

    /**
     * @param  int|float  $value
     *
     * @return int|float
     */
    abstract function getCost(int|float $value): int|float;

}