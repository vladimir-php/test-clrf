<?php

namespace App\Validators;

/**
 *
 */
class ValidationData
{

    /**
     * @param  array  $data
     */
    public function __construct(protected array $data = [])
    {

    }

    /**
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        if (!array_key_exists($key, $this->data) ) {
            return $default;
        }
        return $this->data[$key];
    }

}