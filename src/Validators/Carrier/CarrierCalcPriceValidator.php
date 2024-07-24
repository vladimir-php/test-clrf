<?php

namespace App\Validators\Carrier;

use App\Validators\Validator;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *
 */
class CarrierCalcPriceValidator extends Validator
{

    /**
     * @return array
     */
    protected function constraints(): array
    {
        return [
            'carrier_id' => [
                new Assert\NotBlank(),
                new Assert\Type('numeric'),
                new Assert\Positive(),
            ],
            'weight' => [
                new Assert\NotBlank(),
                new Assert\Type('numeric'),
                new Assert\Positive(),
            ],
        ];
    }

    /**
     * @return bool
     */
    protected function autoValidateRequest(): bool
    {
        return false;
    }

}