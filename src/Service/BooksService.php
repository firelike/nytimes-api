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
        var_dump($validator->isValid($request));

        $httpResponse = $this->apiCall('/lists', $request->toArray());
        var_dump($httpResponse);
        die();
        return @json_decode($httpResponse->getBody()->getContents());
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

        $httpResponse = $this->apiCall('/lists/best-sellers/history', $request->toArray());
        return @json_decode($httpResponse->getBody()->getContents());
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

        $httpResponse = $this->apiCall('/lists/names', $request->toArray());
        return @json_decode($httpResponse->getBody()->getContents());
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

        $httpResponse = $this->apiCall('/lists/overview', $request->toArray());
        return @json_decode($httpResponse->getBody()->getContents());
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

        $path = sprintf('/lists/%s/%s', $request->getDate(), $request->getList());
        $httpResponse = $this->apiCall($path, $request->toArray());
        return @json_decode($httpResponse->getBody()->getContents());
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

        $httpResponse = $this->apiCall('/reviews', $request->toArray());
        return @json_decode($httpResponse->getBody()->getContents());
    }


    /**
     * @param string $path
     * @param array $query
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function apiCall($path, $query)
    {
        if (!$this->getServiceUrl() || !$this->getVersion() || !$this->getFormat()) {
            throw new \Exception('Required Parameter is not set');
        }

        // prepend service path and append response format
        $path = sprintf('/svc/books/%s%s.%s', $this->getVersion(), $path, $this->getFormat());

        try {
            $client = new Client([
                'base_uri' => $this->getServiceUrl()
            ]);
            return $client->request('GET', $path, array(
                    'query' => $query
                )
            );
        } catch (RequestException $zhce) {
            $message = 'Error in request to Web service: ' . $zhce->getMessage();
            throw new \Exception($message, $zhce->getCode());
        } catch (ClientException $zhce) {
            $message = 'Error in request to Web service: ' . $zhce->getMessage();
            throw new \Exception($message, $zhce->getCode());
        }
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