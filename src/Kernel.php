<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * @param  ContainerBuilder  $container
     *
     * @return void
     */
    protected function prepareContainer(ContainerBuilder $container): void
    {
        $container->registerExtension(new CarrierExtension());
        parent::prepareContainer($container);
    }

}
