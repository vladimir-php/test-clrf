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
                new Assert\Length(null, 1, 10),
            ],
        ];
    }

}