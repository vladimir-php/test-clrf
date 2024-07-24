<?php

namespace App\Services\Carrier\Rules\Conditions;

/**
 *
 */
abstract class ThresholdCondition implements ConditionInterface
{

    /**
     * @param  int|float  $threshold
     */
    public function __construct(protected int|float $threshold)
    {

    }


}