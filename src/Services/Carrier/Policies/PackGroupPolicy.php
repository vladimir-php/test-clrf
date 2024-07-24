<?php

namespace App\Services\Carrier\Policies;

use App\Services\Carrier\Rules\Calculations\RatioCalculation;
use App\Services\Carrier\Rules\Conditions\NullCondition;
use App\Services\Carrier\Rules\Rule;

/**
 *
 */
class PackGroupPolicy extends Policy
{

    /**
     *
     */
    public function __construct()
    {
        $this->addRule(new Rule(new NullCondition(), new RatioCalculation(1)));
    }

}