<?php

namespace App\Services\Carrier\Rules\Conditions;


/**
 *
 */
interface ConditionInterface
{

    /**
     * @param  int|float  $weight
     *
     * @return bool
     */
    public function match(int|float $weight): bool;

}