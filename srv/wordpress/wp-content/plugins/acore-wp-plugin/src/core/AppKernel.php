<?php

use \Symfony\Component\Config\Loader\LoaderInterface;
use \Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel {

    public function __construct($environment, $debug) {
        parent::__construct($environment, $debug);
    }

    public function registerBundles() {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            #new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle()
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        $bundles = array_merge($bundles, ACore\Framework\ACoreFramework::getBundles());

        return $bundles;
    }

    public function getRootDir() {
        return ACORE_PATH_PLG;
    }

    public function getCacheDir() {
        return ACORE_PATH_PLG . '/var/cache/' . $this->getEnvironment();
    }

    public function getLogDir() {
        return ACORE_PATH_PLG . '/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }

}
