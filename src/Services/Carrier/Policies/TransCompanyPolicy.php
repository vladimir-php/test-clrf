<?php

namespace App\Services\Carrier\Policies;

use App\Services\Carrier\Rules\Calculations\FixedCalculation;
use App\Services\Carrier\Rules\Conditions\GreaterThanOrEqualCondition;
use App\Services\Carrier\Rules\Conditions\LessThanCondition;
use App\Services\Carrier\Rules\Rule;

/**
 *
 */
class TransCompanyPolicy extends Policy
{

    /**
     *
     */
    public function __construct()
    {
        $this->addRule(new Rule(new LessThanCondition(10), new FixedCalculation(20)))
            ->addRule(new Rule(new GreaterThanOrEqualCondition(10), new FixedCalculation(100)));
    }

}