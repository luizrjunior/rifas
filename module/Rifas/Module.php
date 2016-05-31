<?php

namespace Rifas;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Rifas\Service\RifasService' => function($em) {
                    return new Service\RifasService($em->get('Doctrine\ORM\EntityManager'));
                },
                'Rifas\Service\PremiadoService' => function($em) {
                    return new Service\PremiadoService($em->get('Doctrine\ORM\EntityManager'));
                },
                'Rifas\Service\UsuarioService' => function($em) {
                    return new Service\UsuarioService($em->get('Doctrine\ORM\EntityManager'));
                },
            )
        );
    }

}
