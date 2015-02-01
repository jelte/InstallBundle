<?php
/**
 * Created by PhpStorm.
 * User: jeltesteijaert
 * Date: 01/02/15
 * Time: 15:21
 */

namespace Jelte\Bundle\InstallBundle;


abstract class Kernel extends \Symfony\Component\HttpKernel\Kernel
{
    protected function doRegisterBundles(array $bundles)
    {
        if ( !file_exists('config/parameters.yml') ) {
            return array(
                new \Jelte\Bundle\InstallBundle\InstallBundle()
            );
        }

        return $bundles;
    }

    /**
     * Boots the current kernel.
     *
     * @api
     */
    public function boot()
    {
        if ( file_exists('config/parameter.yml') ) {
            parent::boot();
        } else {

            // init container
            $this->container = new \Symfony\Component\DependencyInjection\Container();
            $this->container->set('kernel', $this);
            $this->container->set('event_dispatcher', new \Symfony\Component\EventDispatcher\EventDispatcher());

            // init bundles
            $this->initializeBundles();
            $this->booted = true;
        }
    }
}