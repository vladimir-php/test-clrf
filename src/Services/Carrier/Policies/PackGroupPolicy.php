<?php

namespace App\Services\Carrier\Policies;

/**
 *
 */
class PackGroupPolicy implements PolicyInterface
{

    /**
     * @param  int|float  $weight
     *
     * @return int|float
     */
    public function calculate(int|float $weight): int|float
    {
        return 0;
    }

}