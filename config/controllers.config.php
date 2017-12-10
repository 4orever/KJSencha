<?php

namespace KJSencha;

use Interop\Container\ContainerInterface;

return array(
    'factories' => array(
        'kjsencha_direct' => function(ContainerInterface $container) {
            $config = $container->get('Config');

            /* @var $manager \KJSencha\Direct\DirectManager */
            $manager = $container->get('kjsencha.direct.manager');
            /* @var $apiFactory \KJSencha\Direct\Remoting\Api\Api */
            $apiFactory = $container->get('kjsencha.api');

            $controller = new Controller\DirectController($manager, $apiFactory);
            $controller->setDebugMode($config['kjsencha']['debug_mode']);

            return $controller;
        },
        'kjsencha_data' => function(ContainerInterface $container) {
            /* @var $componentManager \KJSencha\Service\ComponentManager */
            $componentManager = $container->get('kjsencha.componentmanager');
            return new Controller\DataController($componentManager);
        },
    )
);