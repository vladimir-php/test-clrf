<?php

namespace App\Services\Carrier\Policies;

/**
 *
 */
class TransCompanyPolicy implements PolicyInterface
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