<?php

namespace App;

use App\Services\Carrier\CarrierService;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @todo probably a better solution is to move all the logic & config to a separate bundle
 */
class CarrierExtension extends Extension
{

    /**
     * @param  array             $configs
     * @param  ContainerBuilder  $container
     *
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->register('carrier_service', CarrierService::class)
            ->addArgument($configs)
            ->setPublic(true);
    }

}
