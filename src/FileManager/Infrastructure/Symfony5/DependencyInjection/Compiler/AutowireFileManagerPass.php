<?php

namespace FileManager\Infrastructure\Symfony5\DependencyInjection\Compiler;

use ReflectionClass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AutowireFileManagerPass implements CompilerPassInterface
{

    public function __construct()
    {}

    public function process(ContainerBuilder $container)
    {
        $ids = $container->findTaggedServiceIds('filemanager.autowire');
        foreach (array_keys($ids) as $className) {
            $rf = new ReflectionClass($className);
            foreach ($rf->getInterfaces() as $interface) {
                if (strpos($interface->getName(), 'FileManager') === 0) {
                    $container->autowire($interface->getName(), $className);
                }
            }

        }
    }
}