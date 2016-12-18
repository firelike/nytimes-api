<?php
namespace Firelike\NYTimesTest\Service;


use Firelike\NYTimes\Service\BooksService;

class BooksServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @var BooksService
     */
    private $service;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->service = new BooksService();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->service = null;
        parent::tearDown();
    }

    public function testLists()
    {
        $this->markTestIncomplete("lists test not implemented");

        $this->service->lists(/* parameters */);
    }

    public function testListNames()
    {
        $this->markTestIncomplete("listNames test not implemented");
        $this->service->listNames(/* parameters */);
    }
}

