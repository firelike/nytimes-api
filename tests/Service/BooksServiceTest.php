<?php
namespace Firelike\NYTimes\Test\Service;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../../src/Service/BooksService.php';

require_once __DIR__ . '/../../src/Request/AbstractRequest.php';
require_once __DIR__ . '/../../src/Request/Books/Lists.php';
require_once __DIR__ . '/../../src/Request/Books/ListNames.php';
require_once __DIR__ . '/../../src/Request/Books/History.php';
require_once __DIR__ . '/../../src/Request/Books/Overview.php';
require_once __DIR__ . '/../../src/Request/Books/Reviews.php';

require_once __DIR__ . '/../../src/Validator/BooksServiceRequestValidator.php';
require_once __DIR__ . '/../../src/Validator/OffsetValidator.php';
require_once __DIR__ . '/../../src/Validator/SortOrderValidator.php';

use Firelike\NYTimes\Request\Books\History;
use Firelike\NYTimes\Request\Books\ListNames;
use Firelike\NYTimes\Request\Books\Lists;
use Firelike\NYTimes\Request\Books\Overview;
use Firelike\NYTimes\Request\Books\Reviews;
use Firelike\NYTimes\Service\BooksService;
use Firelike\NYTimes\Validator\BooksServiceRequestValidator;
use Firelike\NYTimes\Validator\OffsetValidator;
use Firelike\NYTimes\Validator\SortOrderValidator;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\ResultInterface;


class BooksServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Firelike\NYTimes\Service\BooksService
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();

        $client = new Client();

        $config = include __DIR__ . '/../../config/module.config.php';
        $description = new Description($config['nytimes_service']['description']);

        $this->service = new BooksService($client, $description);

        // to run the test set an environment variable
        // with name 'nytimes_api_key' and value your NYTimes API key
        $apiKey = getenv('nytimes_api_key');
        $this->service->setApiKey($apiKey);

        $validator = new BooksServiceRequestValidator();
        $validator->setOffsetValidator(new OffsetValidator());
        $validator->setSortOrderValidator(new SortOrderValidator());

        $this->service->setRequestValidator($validator);

    }

    public function testLists()
    {
        $request = new Lists();
        $request->setList('fiction');

        $result = $this->service->bestSellerList($request);
        $this->assertInstanceOf(ResultInterface::class, $result);
        $this->assertArrayHasKey('num_results', $result->toArray());
        $this->assertArrayHasKey('results', $result->toArray());

    }

    public function testHistory()
    {
        $request = new History();
        $result = $this->service->bestSellerHistoryList($request);
        $this->assertInstanceOf(ResultInterface::class, $result);
        $this->assertArrayHasKey('num_results', $result->toArray());
        $this->assertArrayHasKey('results', $result->toArray());
    }

    public function testListNames()
    {
        $request = new ListNames();
        $result = $this->service->bestSellerListNames($request);
        $this->assertInstanceOf(ResultInterface::class, $result);
        $this->assertArrayHasKey('num_results', $result->toArray());
        $this->assertArrayHasKey('results', $result->toArray());
    }

    public function testOverview()
    {
        $request = new Overview();
        $result = $this->service->bestSellerListOverview($request);
        $this->assertInstanceOf(ResultInterface::class, $result);
        $this->assertArrayHasKey('num_results', $result->toArray());
        $this->assertArrayHasKey('results', $result->toArray());
    }

    public function testListByDate()
    {
        $request = new Lists();
        $request->setDate('2016-10-20')->setList('hardcover-fiction');

        $result = $this->service->bestSellerListByDate($request);
        $this->assertInstanceOf(ResultInterface::class, $result);
        $this->assertArrayHasKey('num_results', $result->toArray());
        $this->assertArrayHasKey('results', $result->toArray());
    }

    public function testReviews()
    {
        $request = new Reviews();
        $request->setAuthor('Michael Connelly');

        $result = $this->service->reviews($request);
        $this->assertInstanceOf(ResultInterface::class, $result);
        $this->assertArrayHasKey('num_results', $result->toArray());
        $this->assertArrayHasKey('results', $result->toArray());
    }

}

