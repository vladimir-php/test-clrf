<?php

namespace App\Services\Carrier\Rules\Calculations;


/**
 *
 */
class RatioCalculation implements CalculationInterface
{

    /**
     * @param  int|float  $ratio
     */
    public function __construct(protected int|float $ratio)
    {

    }

    /**
     * @param  int|float  $weight
     *
     * @return int|float
     */
    public function calculate(int|float $weight): int|float
    {
        return $this->ratio * $weight;
    }


}