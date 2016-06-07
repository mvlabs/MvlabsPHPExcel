<?php
/**
 * MvlabsPHPExcel
 *
 * @link      https://github.com/mvlabs/MvlabsPHPExcel
 * @copyright Copyright (c) 2016 Mvlabs
 *
 */

namespace MvlabsPHPExcel;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getServiceConfig()
    {

        return array(
            'invokables' => array(
                'mvlabs.phpexcel.service' => 'MvlabsPHPExcel\Service\MvlabsPHPExcel',
            ),
        );
    }
}
