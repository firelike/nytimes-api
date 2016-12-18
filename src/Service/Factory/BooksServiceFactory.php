<?php
namespace Firelike\NYTimes\Service\Factory;


use Firelike\NYTimes\Service\BooksService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;


class BooksServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {

        $service = new BooksService();

        $config = $sm->get('Config');

        if (isset($config['nytimes_service'])) {

            if (isset($config['nytimes_service']['service_url'])) {
                $service->setServiceUrl($config['nytimes_service']['service_url']);
            }

            if (isset($config['nytimes_service']['version'])) {
                $service->setVersion($config['nytimes_service']['version']);
            }

            if (isset($config['nytimes_service']['format'])) {
                $service->setFormat($config['nytimes_service']['format']);
            }

            if (isset($config['nytimes_service']['api_key'])) {
                $service->setApiKey($config['nytimes_service']['api_key']);
            }

        }

        return $service;

    }

}