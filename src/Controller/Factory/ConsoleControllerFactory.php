<?php
namespace Firelike\NYTimes\Controller\Factory;


use Firelike\NYTimes\Controller\ConsoleController;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;


class ConsoleControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {

        $service = $sm->get('Firelike\NYTimes\Service\BooksService');

        $controller = new ConsoleController();
        $controller->setService($service);

        return $controller;

    }

}