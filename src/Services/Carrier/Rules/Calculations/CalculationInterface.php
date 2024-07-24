<?php

namespace App\Services\Carrier\Rules\Calculations;


/**
 *
 */
interface CalculationInterface
{

    /**
     * @param  int|float  $weight
     *
     * @return int|float
     */
    public function calculate(int|float $weight): int|float;

}