<?php

namespace App\Services\Carrier;


use App\Services\Carrier\Policies\PolicyInterface;

/**
 *
 */
class CarrierService
{

    /**
     * @param  PolicyInterface  $policy
     * @param  int|float        $price
     *
     * @return int|float
     */
    public function calculate(PolicyInterface $policy, int|float $price): int|float
    {
        return $policy->calculate($price);
    }


}