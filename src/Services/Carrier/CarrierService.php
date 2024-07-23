<?php

namespace App\Services\Carrier;

use App\Services\Carrier\Policies\Policy;
use Exception;

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
     *
     * @throws Exception
     */
    public function __construct(array $carriers)
    {
        foreach($carriers as $carrier) {
            $this->carriers[$carrier['name']] = $carrier['policy'];
        }
    }

    /**
     * @param  string  $name
     *
     * @return Policy
     * @throws Exception
     */
    public function createPolicy(string $name): Policy
    {
        if (!array_key_exists($name, $this->carriers)) {
            throw new Exception('Policy key '. $name . ' does not found.');
        }
        return new $this->carriers[$name]();
    }

    /**
     * @return array
     */
    public function getNames(): array
    {
        return array_keys($this->carriers);
    }


}