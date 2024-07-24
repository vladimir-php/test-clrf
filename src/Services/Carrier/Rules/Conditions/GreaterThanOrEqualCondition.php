<?php

namespace App\Services\Carrier\Rules\Conditions;

/**
 *
 */
class GreaterThanOrEqualCondition extends ThresholdCondition
{

    /**
     * @param  int|float  $weight
     *
     * @return bool
     */
    public function match(int|float $weight): bool
    {
        return $weight >= $this->threshold;
    }


}