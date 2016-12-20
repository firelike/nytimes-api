<?php
namespace Firelike\NYTimes\Service;

use Firelike\NYTimes\Request\Books\History;
use Firelike\NYTimes\Request\Books\Overview;
use Firelike\NYTimes\Request\Books\Reviews;
use Firelike\NYTimes\Request\Books\ListNames;
use Firelike\NYTimes\Request\Books\Lists;

use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\ResultInterface;

/**
 * Class BooksService
 * @package Firelike\NYTimes\Service
 *
 * @method ResultInterface lists_command(array $args)
 * @method ResultInterface history_command(array $args)
 * @method ResultInterface list_names_command(array $args)
 * @method ResultInterface overview_command(array $args)
 * @method ResultInterface lists_by_date_command(array $args)
 * @method ResultInterface reviews_command(array $args)
 */
class BooksService extends GuzzleClient
{

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

        return $this->lists_command(array_filter($request->toArray()));
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

        return $this->history_command(array_filter($request->toArray()));
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

        return $this->list_names_command(array_filter($request->toArray()));
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

        return $this->overview_command(array_filter($request->toArray()));
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

        return $this->lists_by_date_command(array_filter($request->toArray()));
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

        return $this->reviews_command(array_filter($request->toArray()));
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