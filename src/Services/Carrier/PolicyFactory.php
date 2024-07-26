<?php

namespace App\Services\Carrier;

use App\Services\Carrier\Policies\PolicyInterface;
use Exception;


class PolicyFactory
{
    /**
     * @var array
     */
    protected array $policies = [];

    /**
     * @param  array  $policies
     *
     * @throws Exception
     */
    public function __construct(array $policies = [])
    {
        foreach($policies as $policy) {
            if (!array_key_exists('name', $policy) || !array_key_exists('class', $policy) ) {
                throw new Exception('Wrong policy data format.');
            }
            $this->policies[$policy['name']] = $policy['class'];
        }
    }

    /**
     * @param  string  $name
     *
     * @return PolicyInterface
     * @throws Exception
     */
    public function create(string $name): PolicyInterface
    {
        $class = $this->findClass($name);
        if (!$class) {
            throw new Exception('Policy class for '.$name.' does not found.');
        }
        if (is_subclass_of($class, 'PolicyInterface')) {
            throw new Exception('Policy '.$name.' is not an instance of '. PolicyInterface::class .'.');
        }
        return new $class();
    }


    /**
     * @param  string  $name
     *
     * @return string|null
     */
    protected function findClass(string $name): ?string
    {
        $class = array_key_exists($name, $this->policies) ?
            $this->policies[$name] : 'App\Services\Carrier\Policies\\'.$name;
        if (class_exists($class) ) {
            return $class;
        }
        return null;
    }



}