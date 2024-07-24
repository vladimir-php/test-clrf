<?php

namespace App\Services\Carrier\Rules\Calculations;


/**
 *
 */
class FixedCalculation implements CalculationInterface
{

    /**
     * @param  int|float  $result
     */
    public function __construct(protected int|float $result)
    {

    }

    /**
     * @param  int|float  $weight
     *
     * @return int|float
     */
    public function calculate(int|float $weight): int|float
    {
        return $this->result;
    }


}