<?php

namespace KJSencha;

use Interop\Container\ContainerInterface;
use KJSencha\View\Helper\ExtJS;
use KJSencha\View\Helper\Variables;
use KJSencha\View\Helper\LoaderConfig;
use KJSencha\View\Helper\DirectApi;

return array(
    'factories' => array(
        'extJs' => function(ContainerInterface $container) {
            $pluginManager = $container->get('ViewHelperManager');
            $config = $container->get('Config');
            /* @var $headLink \Zend\View\Helper\HeadLink */
            $headLink = $pluginManager->get('headLink');
            /* @var $headScript \Zend\View\Helper\HeadScript */
            $headScript = $pluginManager->get('headScript');

            return new ExtJS($config['kjsencha'], $headLink, $headScript);
        },
        'kjSenchaVariables' => function(ContainerInterface $container) {
            $pluginManager = $container->get('ViewHelperManager');
            /* @var $headScript \Zend\View\Helper\HeadScript */
            $headScript = $pluginManager->get('headScript');
            /* @var $bootstrap \KJSencha\Frontend\Bootstrap */
            $bootstrap = $container->get('kjsencha.bootstrap');

            return new Variables($headScript, $bootstrap);
        },
        'kjSenchaLoaderConfig' => function(ContainerInterface $container) {
            $pluginManager = $container->get('ViewHelperManager');
            /* @var $basePath \Zend\View\Helper\BasePath */
            $basePath = $pluginManager->get('basePath');
            /* @var $headScript \Zend\View\Helper\HeadScript */
            $headScript = $pluginManager->get('headScript');
            /* @var $bootstrap \KJSencha\Frontend\Bootstrap */
            $bootstrap = $container->get('kjsencha.bootstrap');

            return new LoaderConfig($basePath, $headScript, $bootstrap);
        },
        'kjSenchaDirectApi' => function(ContainerInterface $container) {
            $pluginManager = $container->get('ViewHelperManager');
            /* @var $headScript \Zend\View\Helper\HeadScript */
            $headScript = $pluginManager->get('headScript');
            /* @var $bootstrap \KJSencha\Frontend\Bootstrap */
            $bootstrap = $container->get('kjsencha.bootstrap');

            return new DirectApi($headScript, $bootstrap);
        },
    )
);