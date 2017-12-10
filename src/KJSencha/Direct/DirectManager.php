<?php

namespace KJSencha\Direct;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Manages the creation of Direct classes
 */
class DirectManager extends AbstractPluginManager
{
    /**
     * DirectManager constructor.
     * @param ContainerInterface|ServiceLocatorInterface $container
     * @param array $config
     */
    public function __construct(ContainerInterface $container, array $config = [])
    {
        parent::__construct($container, $config);
    }

    public function validate($instance)
    {
        return parent::validate($instance);
    }
}
