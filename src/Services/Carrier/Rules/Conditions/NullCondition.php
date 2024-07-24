<?php

namespace App\Services\Carrier\Rules\Conditions;

/**
 *
 */
class NullCondition implements ConditionInterface
{

    /**
     * @param  int|float  $weight
     *
     * @return bool
     */
    public function match(int|float $weight): bool
    {
        return true;
    }


}