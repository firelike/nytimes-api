<?php
namespace Firelike\NYTimes\Controller;

use Firelike\NYTimes\Request\AbstractRequest;
use Firelike\NYTimes\Request\Books\History;
use Firelike\NYTimes\Request\Books\ListNames;
use Firelike\NYTimes\Request\Books\Lists;
use Firelike\NYTimes\Request\Books\Overview;
use Firelike\NYTimes\Request\Books\Reviews;
use Zend\Mvc\Console\Controller\AbstractConsoleController;


class ConsoleController extends AbstractConsoleController
{
    /**
     * @var \Firelike\NYTimes\Service\BooksService
     */
    protected $service;

    public function listsAction()
    {
        $this->markBegin();

        $request = new Lists();

        $listName = $this->getRequest()->getParam('list-name');
        if ($listName) {
            $request->setList($listName);
        } else {
            $request->setList('hardcover-fiction');
        }

        $request->setSortOrder(AbstractRequest::SORT_ORDER_ASC);

        $result = $this->getService()->bestSellerList($request);

        $records = $result->toArray()['results'];

        var_dump($records);

        $this->markEnd();
    }

    public function historyAction()
    {
        $this->markBegin();

        $request = new History();

        $author = $this->getRequest()->getParam('author');
        if ($author) {
            $request->setAuthor($author);
        } else {
            $request->setAuthor('Michael Connelly');
        }

        $result = $this->getService()->bestSellerHistoryList($request);

        $records = $result->toArray()['results'];

        var_dump($records);

        $this->markEnd();
    }

    public function listNamesAction()
    {
        $this->markBegin();

        $request = new ListNames();

        $result = $this->getService()->bestSellerListNames($request);

        $records = $result->toArray()['results'];

        var_dump($records);

        $this->markEnd();
    }

    public function overviewAction()
    {
        $this->markBegin();

        $request = new Overview();
        $request->setPublishedDate('2016-01-10');

        $result = $this->getService()->bestSellerListOverview($request);

        $records = $result->toArray()['results'];

        var_dump($records);

        $this->markEnd();
    }

    public function listByDateAction()
    {
        $this->markBegin();

        $request = new Lists();

        $listName = $this->getRequest()->getParam('list-name');
        if ($listName) {
            $request->setList($listName);
        } else {
            $request->setList('hardcover-fiction');
        }

        $date = $this->getRequest()->getParam('date');
        if ($date) {
            $request->setDate($date);
        } else {
            $request->setDate('2016-10-21');
        }

        $result = $this->getService()->bestSellerListByDate($request);

        $records = $result->toArray()['results'];

        var_dump($records);

        $this->markEnd();
    }

    public function reviewsAction()
    {
        $this->markBegin();

        $request = new Reviews();

        $author = $this->getRequest()->getParam('author');
        if ($author) {
            $request->setAuthor($author);
        } else {
            $request->setAuthor('John Grisham');
        }

        $result = $this->getService()->reviews($request);

        $records = $result->toArray()['results'];

        var_dump($records);


        $this->markEnd();
    }


    public function markBegin()
    {
        $delimiter = str_repeat('=', 10);
        $this->getConsole()->writeLine(implode('BEGIN', [
            $delimiter,
            $delimiter
        ]));
    }

    public function markEnd()
    {
        $request = $this->getRequest();
        $verbose = $request->getParam('verbose') || $request->getParam('v');

        if ($verbose) {
            $this->getConsole()->writeLine("Done");
        }

        $delimiter = str_repeat('=', 10);
        $this->getConsole()->writeLine(implode('END', [
            $delimiter,
            $delimiter
        ]));
    }

    /**
     * @return \Firelike\NYTimes\Service\BooksService
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param \Firelike\NYTimes\Service\BooksService $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }


}

