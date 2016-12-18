<?php
return array(
    'controllers' => array(
        'factories' => [
            'Firelike\NYTimes\Controller\Console' => Firelike\NYTimes\Controller\Factory\ConsoleControllerFactory::class
        ]
    ),
    'service_manager' => array(
        'factories' => array(
            Firelike\NYTimes\Service\BestSellersService::class => Firelike\NYTimes\Service\Factory\BestSellersServiceFactory::class,
        )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'usatoday-lists' => array(
                    'options' => array(
                        'route' => 'usatoday lists [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\NYTimes\Controller\Console',
                            'action' => 'lists'
                        )
                    )
                ),
                'usatoady-list-names' => array(
                    'options' => array(
                        'route' => 'usatoday list-names [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\NYTimes\Controller\Console',
                            'action' => 'list-names'
                        )
                    )
                )
            )
        )
    )
);


