<?php

namespace KJSencha\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ApiFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /* @var $config array */
        $config = $container->get('Config');
        /* @var $cache \Zend\Cache\Storage\StorageInterface */
        $cache = $container->get('kjsencha.cache');
        /* @var $router \Zend\Router\Http\RouteInterface */
        $router = $container->get('HttpRouter');
        /* @var $api \KJSencha\Direct\Remoting\Api\Api */
        $api = $cache->getItem($config['kjsencha']['cache_key'], $success);

        if (!$success) {
            /* @var $apiFactory \KJSencha\Direct\Remoting\Api\Factory\ApiBuilder */
            $apiFactory = $container->get('kjsencha.apibuilder');
            /* @var $request \Zend\Http\PhpEnvironment\Request */
            $request = $container->get('Request');
            $api = $apiFactory->buildApi($config['kjsencha']['direct']);
            $url = $request->getBasePath() . $router->assemble(
                    array('action' => 'rpc'),
                    array('name' => 'kjsencha-direct')
                );
            $api->setUrl($url);
            $cache->setItem($config['kjsencha']['cache_key'], $api);
        }

        return $api;
    }
}
