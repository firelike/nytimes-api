<?php
namespace Firelike\NYTimes\Service\Factory;


use Firelike\NYTimes\Service\BooksService;
use GuzzleHttp\Command\Guzzle\Description;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use GuzzleHttp\Client;


class BooksServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {

        $config = $sm->get('Config');

        if (!isset($config['nytimes_service'])) {
            throw  new \Exception('Required configuration node - nytimes_service is missing');
        }

        if (!isset($config['nytimes_service']['api_key'])) {
            throw  new \Exception('Required nytimes_service configuration parameters are missing is missing');
        }

        if (!isset($config['nytimes_service']['description'])) {
            throw  new \Exception('Required nytimes_service configuration parameters are missing is missing');
        }

        $client = new Client();

        $description = new Description($config['nytimes_service']['description']);

        $service = new BooksService($client, $description);

        $service->setApiKey($config['nytimes_service']['api_key']);

        $service->setRequestValidator($sm->get('Firelike\NYTimes\Validator\BooksServiceRequestValidator'));

        return $service;

    }

}