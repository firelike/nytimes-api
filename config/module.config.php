<?php
return array(
    'controllers' => array(
        'factories' => [
            'Firelike\NYTimes\Controller\Console' => Firelike\NYTimes\Controller\Factory\ConsoleControllerFactory::class
        ]
    ),
    'service_manager' => array(
        'factories' => array(
            Firelike\NYTimes\Service\BooksService::class => Firelike\NYTimes\Service\Factory\BooksServiceFactory::class,
            Firelike\NYTimes\Validator\BooksServiceRequestValidator::class => Firelike\NYTimes\Validator\Factory\BooksServiceRequestValidatorFactory::class,
            Firelike\NYTimes\Validator\SortOrderValidator::class => Firelike\NYTimes\Validator\Factory\SortOrderValidatorFactory::class,
            Firelike\NYTimes\Validator\OffsetValidator::class => Firelike\NYTimes\Validator\Factory\OffsetValidatorFactory::class,
        )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'nytimes-lists' => array(
                    'options' => array(
                        'route' => 'nytimes lists [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\NYTimes\Controller\Console',
                            'action' => 'lists'
                        )
                    )
                ),
                'nytimes-history' => array(
                    'options' => array(
                        'route' => 'nytimes history [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\NYTimes\Controller\Console',
                            'action' => 'history'
                        )
                    )
                ),
                'nytimes-list-names' => array(
                    'options' => array(
                        'route' => 'nytimes list-names [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\NYTimes\Controller\Console',
                            'action' => 'list-names'
                        )
                    )
                ),
                'nytimes-list-overview' => array(
                    'options' => array(
                        'route' => 'nytimes overview [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\NYTimes\Controller\Console',
                            'action' => 'overview'
                        )
                    )
                ),
                'nytimes-list-by-date' => array(
                    'options' => array(
                        'route' => 'nytimes list-by-date [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\NYTimes\Controller\Console',
                            'action' => 'list-by-date'
                        )
                    )
                ),
                'nytimes-list-reviews' => array(
                    'options' => array(
                        'route' => 'nytimes reviews [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\NYTimes\Controller\Console',
                            'action' => 'reviews'
                        )
                    )
                )
            )
        )
    )
);


