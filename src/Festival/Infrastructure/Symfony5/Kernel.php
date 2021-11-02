<?php

namespace Symfony5;

use Festival\Infrastructure\Symfony5\DependencyInjection\Compiler\AutowireFestivalPass;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private const DIR = '/var/www/html/';
    private const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    protected function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AutowireFestivalPass());
    }

    protected function configureContainer(ContainerConfigurator $container, LoaderInterface $loader): void
    {
        $container->import(self::DIR.'config/{packages}/*.yaml');
        $container->import(self::DIR.'config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file(self::DIR.'config/services.yaml')) {
            $container->import(self::DIR.'config/services.yaml');
            $container->import(self::DIR.'config/{services}_'.$this->environment.'.yaml');
//            $loader->load($confDir.'/{services}'.self::CONFIG_EXTS, 'glob');
//            $loader->load($confDir.'/{services}_'.$this->environment.self::CONFIG_EXTS, 'glob');
        } else {
            $container->import(self::DIR.'config/{services}.php');
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import(self::DIR.'config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import(self::DIR.'config/{routes}/*.yaml');

        if (is_file(self::DIR.'config/routes.yaml')) {
            $routes->import(self::DIR.'config/routes.yaml');
        } else {
            $routes->import(self::DIR.'config/{routes}.php');
        }
    }
}
