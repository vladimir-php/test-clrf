<?php

namespace App\Services\Carrier\Policies;

/**
 *
 */
interface PolicyInterface
{

    /**
     * @param  int|float  $weight
     *
     * @return int|float
     */
    public function calculate(int|float $weight): int|float;

}