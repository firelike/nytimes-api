<?php
namespace Firelike\NYTimes\Service\Factory;


use Firelike\NYTimes\Service\BestSellersService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;


class BestSellersServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {

        $service = new BestSellersService();

        $config = $sm->get('Config');
        if (isset($config['nytimes_service'])) {

            if (isset($config['nytimes_service']['service_url'])) {
                $service->setServiceUrl($config['nytimes_service']['service_url']);
            }

            if (isset($config['nytimes_service']['service_version'])) {
                $service->setVersion($config['nytimes_service']['service_version']);
            }

            if (isset($config['nytimes_service']['apy_key'])) {
                $service->setApiKey($config['nytimes_service']['apy_key']);
            }

        }

        return $service;

    }

}