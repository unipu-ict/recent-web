<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
<<<<<<< HEAD
<<<<<<< HEAD
=======
use JMS\Serializer\SerializerBuilder;
>>>>>>> 42de2340cb8d642fdcc43bea458ef2871aaed8fd
=======
use JMS\Serializer\SerializerBuilder;
>>>>>>> masimo

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> masimo
            new FOS\UserBundle\FOSUserBundle(),
            new RecENT\UserBundle\RecENTUserBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new Nelmio\CorsBundle\NelmioCorsBundle(),
<<<<<<< HEAD
>>>>>>> 42de2340cb8d642fdcc43bea458ef2871aaed8fd
=======
>>>>>>> masimo
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
