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
     * @param  int|float        $weight
     *
     * @return int|float
     */
    public function calculate(PolicyInterface $policy, int|float $weight): int|float
    {
        return $policy->calculate($weight);
    }


}