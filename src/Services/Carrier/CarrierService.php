<?php

namespace App\Services\Carrier;

/**
 *
 */
class CarrierService
{

    /**
     * @var array
     */
    protected array $carriers = [];

    /**
     * @param  array  $carriers
     */
    public function __construct(array $carriers)
    {
        foreach($carriers[0] as $carrier) {
            $this->carriers[$carrier['name']] = $carrier['policy'];
        }
    }

}