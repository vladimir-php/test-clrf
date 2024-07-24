<?php

namespace App\Services\Carrier\Policies;

use App\Services\Carrier\Rules\Rule;

/**
 *
 */
abstract class Policy implements PolicyInterface
{

    /**
     * @var array
     */
    protected array $rules = [];

    /**
     * @param  Rule  $rule
     *
     * @return self
     */
    public function addRule(Rule $rule): self
    {
        $this->rules[] = $rule;
        return $this;
    }

    /**
     * @param  int|float  $weight
     *
     * @return int|float
     */
    public function calculate(int|float $weight): int|float
    {
        foreach($this->rules as $rule) {
            if ($rule->match($weight) ) {
                return $rule->calculate($weight);
            }
        }
    }

}
