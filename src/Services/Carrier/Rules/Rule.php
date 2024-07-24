<?php

namespace App\Services\Carrier\Rules;

use App\Services\Carrier\Rules\Calculations\CalculationInterface;
use App\Services\Carrier\Rules\Conditions\ConditionInterface;

/**
 *
 */
class Rule
{

    /**
     * @param  ConditionInterface    $condition
     * @param  CalculationInterface  $calculation
     */
    public function __construct(
        protected ConditionInterface $condition,
        protected CalculationInterface $calculation
    )
    {

    }

    /**
     * @param  int|float  $weight
     *
     * @return bool
     */
    public function match(int|float $weight): bool
    {
        return $this->condition->match($weight);
    }

    /**
     * @param  int|float  $weight
     *
     * @return int|float
     */
    public function calculate(int|float $weight): int|float
    {
        return $this->calculation->calculate($weight);
    }



}