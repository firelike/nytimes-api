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
                        'route' => 'nytimes lists [--list-name=] [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\NYTimes\Controller\Console',
                            'action' => 'lists'
                        )
                    )
                ),
                'nytimes-history' => array(
                    'options' => array(
                        'route' => 'nytimes history [--author=] [--verbose|-v]',
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
                        'route' => 'nytimes list-by-date [--list-name=] [--date=] [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\NYTimes\Controller\Console',
                            'action' => 'list-by-date'
                        )
                    )
                ),
                'nytimes-list-reviews' => array(
                    'options' => array(
                        'route' => 'nytimes reviews [--author=] [--verbose|-v]',
                        'defaults' => array(
                            'controller' => 'Firelike\NYTimes\Controller\Console',
                            'action' => 'reviews'
                        )
                    )
                )
            )
        )
    ),
    'nytimes_service' => [
        'description' => [
            'baseUri' => 'https://api.nytimes.com',
            'apiVersion' => 'v3',
            'operations' => [
                'lists_command' => [
                    'httpMethod' => 'GET',
                    'uri' => '/svc/books/v3/lists.json',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'api-key' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'query'
                        ],
                        'list' => [
                            'type' => 'string',
                            'location' => 'query'
                        ],
                        'weeks-on-list' => [
                            'type' => 'integer',
                            'location' => 'query'
                        ],
                        'bestsellers-date' => [
                            'type' => 'date-time',
                            'required' => false,
                            'location' => 'query',
                        ],
                        'date' => [
                            'type' => 'string',
                            'required' => false,
                            'location' => 'query'
                        ],
                        'isbn' => [
                            'type' => 'string',
                            'location' => 'query'
                        ],
                        'published-date' => [
                            'type' => 'string',
                            'required' => false,
                            'location' => 'query'
                        ],
                        'rank' => [
                            'type' => 'integer',
                            'location' => 'query'
                        ],
                        'rank-last-week' => [
                            'type' => 'integer',
                            'location' => 'query'
                        ],
                        'offset' => [
                            'type' => 'integer',
                            'location' => 'query'
                        ],
                        'sort-order' => [
                            'type' => 'string',
                            'location' => 'query'
                        ]
                    ]
                ],
                'history_command' => [
                    'httpMethod' => 'GET',
                    'uri' => '/svc/books/v3/lists/best-sellers/history.json',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'age-group' => [
                            "location" => "query",
                            "description" => "The target age group for the best seller.",
                            "type" => "string"
                        ],
                        'author' => [
                            "location" => "query",
                            "description" => "The author of the best seller. The author field does not include additional contributors (see Data Structure for more details about the author and contributor fields).\n\nWhen searching the author field, you can specify any combination of first, middle and last names.\n\nWhen sort-by is set to author, the results will be sorted by author's first name. ",
                            "type" => "string"
                        ],
                        'contributor' => [
                            "name" => "contributor",
                            "location" => "query",
                            "description" => "The author of the best seller, as well as other contributors such as the illustrator (to search or sort by author name only, use author instead).\n\nWhen searching, you can specify any combination of first, middle and last names of any of the contributors.\n\nWhen sort-by is set to contributor, the results will be sorted by the first name of the first contributor listed. ",
                            "type" => "string"
                        ],
                        'isbn' => [
                            "location" => "query",
                            "description" => "International Standard Book Number, 10 or 13 digits\n\nA best seller may have both 10-digit and 13-digit ISBNs, and may have multiple ISBNs of each type. To search on multiple ISBNs, separate the ISBNs with semicolons (example: 9780446579933;0061374229).",
                            "type" => "string"
                        ],
                        'price' => [
                            "location" => "query",
                            "description" => "The publisher's list price of the best seller, including decimal point",
                            "type" => "string"
                        ],
                        'publisher' => [
                            "location" => "query",
                            "description" => "The standardized name of the publisher",
                            "type" => "string"
                        ],
                        'title' => [
                            "location" => "query",
                            "description" => "The title of the best seller\n\nWhen searching, you can specify a portion of a title or a full title.",
                            "type" => "string"
                        ],
                        'api-key' => [
                            "location" => "query",
                            'required' => true,
                            "description" => "api key",
                            "type" => "string"
                        ]
                    ]
                ],
                'list_names_command' => [
                    'httpMethod' => 'GET',
                    'uri' => '/svc/books/v3/lists/names.json',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'api-key' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'query'
                        ]
                    ]
                ],
                'overview_command' => [
                    'httpMethod' => 'GET',
                    'uri' => '/svc/books/v3/lists/overview.json',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'api-key' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'query'
                        ],
                        'published_date' => [
                            'type' => 'string',
                            'location' => 'query'
                        ],
                    ]
                ],
                'lists_by_date_command' => [
                    'httpMethod' => 'GET',
                    'uri' => '/svc/books/v3/lists/{date}/{list}.json',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'api-key' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'query'
                        ],
                        'date' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'uri'
                        ],
                        'list' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'uri'
                        ],
                        'isbn' => [
                            'type' => 'integer',
                            'location' => 'query'
                        ],
                        'list-name' => [
                            'type' => 'string',
                            'location' => 'query'
                        ],
                        'published-date' => [
                            'type' => 'date-time',
                            'location' => 'query'
                        ],
                        'bestsellers-date' => [
                            'type' => 'string',
                            'location' => 'query'
                        ],
                        'weeks-on-list' => [
                            'type' => 'integer',
                            'location' => 'query'
                        ],
                        'rank' => [
                            'type' => 'string',
                            'location' => 'query'
                        ],
                        'rank-last-week' => [
                            'type' => 'integer',
                            'location' => 'query'
                        ],
                        'offset' => [
                            'type' => 'integer',
                            'location' => 'query'
                        ],
                        'sort-order' => [
                            'type' => 'string',
                            'location' => 'query'
                        ],
                    ],
                ],
                'reviews_command' => [
                    'httpMethod' => 'GET',
                    'uri' => '/svc/books/v3/reviews.json',
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'api-key' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'query'
                        ],
                        'isbn' => [
                            'type' => 'integer',
                            'location' => 'query'
                        ],
                        'title' => [
                            'type' => 'string',
                            'location' => 'query'
                        ],
                        'author' => [
                            'type' => 'string',
                            'location' => 'query'
                        ]
                    ]
                ]
            ],
            'models' => [
                'getResponse' => [
                    'type' => 'object',
                    "properties" => [
                        "success" => [
                            "type" => "string",
                            "required" => true
                        ],
                        "errors" => [
                            "type" => "array",
                            "items" => [
                                "type" => "object",
                                "properties" => [
                                    "code" => [
                                        "type" => "string",
                                        "description" => "The error code."
                                    ],
                                    "message" => [
                                        "type" => "string",
                                        "description" => "The detailed message from the server."
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'additionalProperties' => [
                        'location' => 'json'
                    ]
                ]
            ]
        ]
    ]
);


