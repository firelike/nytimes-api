<?php
namespace Firelike\NYTimes\Service;

use GuzzleHttp\Exception\ClientException;
use Firelike\NYTimes\Request\ListNames;
use Firelike\NYTimes\Request\Lists;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class BestSellersService
{

    //const LISTS_BASE_URI = 'http://api.nytimes.com/svc/books/{version}/lists';
    const LISTS_BASE_URI = 'http://api.nytimes.com/svc/books/{version}/lists';

    //const LIST_NAMES_BASE_URI = 'http://api.nytimes.com/svc/books/{version}/lists/names';
    const LIST_NAMES_BASE_URI = 'http://api.nytimes.com/svc/books/{version}/lists/names';

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
    protected $apiKey;


    public function lists($arguments = array())
    {
        $arguments = array_merge(array(
            'api-key' => $this->getApiKey()
        ), $arguments);

        $request = new Lists($arguments);


        $uri = str_replace('{version}', $request->getVersion(), self::LISTS_BASE_URI);
        if (strlen($request->getDate()) > 0) {
            $uri = $uri . '/' . $request->getDate();
        }
        $uri = $uri . '/' . $request->getListName() . '.' . $request->getResponseFormat();

        $httpResponse = $this->apiCall($uri, $request);

        $response = @json_decode($httpResponse->getBody()->getContents());

        $status = isset($response['status']) ? $response['status'] : null;
        $copyright = isset($response['copyright']) ? $response['copyright'] : null;
        $numResults = isset($response['num_results']) ? $response['num_results'] : null;
        $lastModified = isset($response['last_modified']) ? $response['last_modified'] : null;

        return (isset($response['results'])) ? $response['results'] : null;

    }


    public function listNames($arguments = array())
    {
        $arguments = array_merge($arguments, array(
            'api-key' => $this->getApiKey()
        ));

        $request = new ListNames($arguments);

        $uri = str_replace('{version}', $request->getVersion(), self::LIST_NAMES_BASE_URI);

        $uri = $uri . $request->getResponseFormat();

        try {
            $httpResponse = $this->apiCall($uri, $request);
        } catch (\Exception $e) {
            throw new \Exception('An error occurred sending request. Status code: ' . $e->getMessage(), 500);
        }

        $response = @json_decode($httpResponse->getBody()->getContents());

        $status = isset($response['status']) ? $response['status'] : null;
        $copyright = isset($response['copyright']) ? $response['copyright'] : null;
        $numResults = isset($response['num_results']) ? $response['num_results'] : null;
        $lastModified = isset($response['last_modified']) ? $response['last_modified'] : null;

        return (isset($response['results'])) ? $response['results'] : null;
    }


    public function apiCall($path, $query)
    {
        if (
            !$this->getVersion()
            || !$this->getServiceUrl()
        ) {
            throw new \Exception('Required Parameter is not set');
        }

        $baseUri = str_replace('{version}', $this->getVersion(), $this->getServiceUrl());

        // append response format
        $path = $path . 'json';

        try {
            $client = new Client([
                'base_uri' => $baseUri
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


}