<?php
namespace Firelike\NYTimes\Test\Service;

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


class BooksServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Firelike\NYTimes\Service\BooksService
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();

        $config = [
            'service_url' => 'https://api.nytimes.com',
            'version' => 'v3',
            'format' => 'json',
            'api_key' => '',
        ];

        $this->service = new BooksService();
        $this->service->setServiceUrl($config['service_url']);
        $this->service->setVersion($config['version']);
        $this->service->setFormat($config['format']);
        $this->service->setApiKey($config['api_key']);

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
        $this->assertArrayHasKey('results', $result);

    }

    public function testHistory()
    {
        $request = new History();

        $result = $this->service->bestSellerHistoryList($request);
        $this->assertArrayHasKey('results', $result);
    }

    public function testListNames()
    {
        $request = new ListNames();

        $result = $this->service->bestSellerListNames($request);
        $this->assertArrayHasKey('results', $result);
    }

    public function testOverview()
    {
        $request = new Overview();

        $result = $this->service->bestSellerListOverview($request);
        $this->assertArrayHasKey('results', $result);
    }

    public function testListByDate()
    {
        $request = new Lists();
        $request->setDate('2016-10-20')->setList('hardcover-fiction');

        $result = $this->service->bestSellerListByDate($request);
        $this->assertArrayHasKey('results', $result);
    }

    public function testReviews()
    {
        $request = new Reviews();
        $request->setAuthor('Michael Connelly');

        $result = $this->service->reviews($request);
        $this->assertArrayHasKey('results', $result);
    }

}

