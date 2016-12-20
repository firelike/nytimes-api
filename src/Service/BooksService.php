<?php
namespace Firelike\NYTimes\Service;

use Firelike\NYTimes\Request\AbstractRequest;
use Firelike\NYTimes\Request\Books\History;
use Firelike\NYTimes\Request\Books\Overview;
use Firelike\NYTimes\Request\Books\Reviews;
use GuzzleHttp\Exception\ClientException;
use Firelike\NYTimes\Request\Books\ListNames;
use Firelike\NYTimes\Request\Books\Lists;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;


class BooksService
{

    /**
     * @var string
     */
    protected $serviceUrl;
    /**
     * @var string
     */
    protected $version;
    /**
     * @var string
     */
    protected $format;
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var \Firelike\NYTimes\Validator\BooksServiceRequestValidator
     */
    protected $requestValidator;

    /**
     * @param Lists $request
     * @return array|mixed
     */
    public function bestSellerList(Lists $request)
    {
        $request->setApiKey($this->getApiKey());

        $validator = $this->getRequestValidator();
        if (!$validator->isValid($request)) {
            return $validator->getMessages();
        }
        return $this->getClient()->lists(array_filter($request->toArray()));
    }

    /**
     * @param History $request
     * @return array|mixed
     */
    public function bestSellerHistoryList(History $request)
    {
        $request->setApiKey($this->getApiKey());

        $validator = $this->getRequestValidator();
        if (!$validator->isValid($request)) {
            return $validator->getMessages();
        }

        return $this->getClient()->history(array_filter($request->toArray()));
    }

    /**
     * @param ListNames $request
     * @return array|mixed
     */
    public function bestSellerListNames(ListNames $request)
    {
        $request->setApiKey($this->getApiKey());

        $validator = $this->getRequestValidator();
        if (!$validator->isValid($request)) {
            return $validator->getMessages();
        }

        return $this->getClient()->listNames(array_filter($request->toArray()));
    }

    /**
     * @param Overview $request
     * @return array|mixed
     */
    public function bestSellerListOverview(Overview $request)
    {
        $request->setApiKey($this->getApiKey());

        $validator = $this->getRequestValidator();
        if (!$validator->isValid($request)) {
            return $validator->getMessages();
        }

        return $this->getClient()->overview(array_filter($request->toArray()));
    }

    /**
     * @param Lists $request
     * @return array|mixed
     */
    public function bestSellerListByDate(Lists $request)
    {
        $request->setApiKey($this->getApiKey());

        $validator = $this->getRequestValidator();
        if (!$validator->isValid($request)) {
            return $validator->getMessages();
        }

        return $this->getClient()->listsByDate(array_filter($request->toArray()));
    }

    /**
     * @param Reviews $request
     * @return array|mixed
     */
    public function reviews(Reviews $request)
    {
        $request->setApiKey($this->getApiKey());

        $validator = $this->getRequestValidator();
        if (!$validator->isValid($request)) {
            return $validator->getMessages();
        }

        return $this->getClient()->reviews(array_filter($request->toArray()));
    }

    protected function pathHelper($path)
    {
        if (!$this->getServiceUrl() || !$this->getVersion() || !$this->getFormat()) {
            throw new \Exception('Required Parameter is not set');
        }

        // prepend service path and append response format
        return sprintf('/svc/books/%s/%s.%s', $this->getVersion(), $path, $this->getFormat());

    }

    protected function getClient()
    {

        $client = new Client();
        $description = new Description([
            'apiVersion' => $this->getVersion(),
            'baseUri' => $this->getServiceUrl(),
            'operations' => [
                'lists' => [
                    'httpMethod' => 'GET',
                    'uri' => $this->pathHelper('lists'),
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
                'history' => [
                    'httpMethod' => 'GET',
                    'uri' => $this->pathHelper('lists/best-sellers/history'),
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
                'listNames' => [
                    'httpMethod' => 'GET',
                    'uri' => $this->pathHelper('lists/names'),
                    'responseModel' => 'getResponse',
                    'parameters' => [
                        'api-key' => [
                            'type' => 'string',
                            'required' => true,
                            'location' => 'query'
                        ]
                    ]
                ],
                'overview' => [
                    'httpMethod' => 'GET',
                    'uri' => $this->pathHelper('lists/overview'),
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
                'listsByDate' => [
                    'httpMethod' => 'GET',
                    'uri' => $this->pathHelper('lists/{date}/{list}'),
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
                'reviews' => [
                    'httpMethod' => 'GET',
                    'uri' => $this->pathHelper('reviews'),
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
                        ],
                    ]
                ],
            ],
            'models' => [
                'getResponse' => [
                    'type' => 'object',
                    'additionalProperties' => [
                        'location' => 'json'
                    ]
                ]
            ]
        ]);

        $guzzleClient = new GuzzleClient($client, $description);
        return $guzzleClient;
    }


    /**
     * @return string
     */
    public function getServiceUrl()
    {
        return $this->serviceUrl;
    }

    /**
     * @param string $serviceUrl
     */
    public function setServiceUrl($serviceUrl)
    {
        $this->serviceUrl = $serviceUrl;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }


    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return \Firelike\NYTimes\Validator\BooksServiceRequestValidator
     */
    public function getRequestValidator()
    {
        return $this->requestValidator;
    }

    /**
     * @param \Firelike\NYTimes\Validator\BooksServiceRequestValidator $requestValidator
     */
    public function setRequestValidator($requestValidator)
    {
        $this->requestValidator = $requestValidator;
    }


}