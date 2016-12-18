<?php
namespace Firelike\NYTimes\Request;

use Zend\Filter\FilterChain;
use Zend\Filter\Word\DashToCamelCase;
use Zend\Filter\Word\UnderscoreToCamelCase;
use Zend\Filter\Callback;


abstract class AbstractRequest
{

    protected $version;

    protected $apiKey;

    protected $responseFormat;

    protected $offset;

    protected $sortOrder;


    public function __construct($options = array())
    {
        $this->setOptions($options);
    }


    /**
     *
     * @param array $options
     * @throws \Exception
     */
    public function setOptions($options = array())
    {
        // Zend Form removes all dashes from the form element names
        // therefore the argument keys come without dashes
        if (isset($options['apikey'])) {
            $options['api-key'] = $options['apikey'];
        }
        if (isset($options['responseformat'])) {
            $options['response-format'] = $options['responseformat'];
        }
        if (isset($options['sortorder'])) {
            $options['sort-order'] = $options['sortorder'];
        }


        // calculate the setter method name
        $filter = new FilterChain();
        $filter->attach(new DashToCamelCase());
        $filter->attach(new UnderscoreToCamelCase());
        $filter->attach(new Callback(array(
            'callback' => 'ucfirst'
        )));

        foreach ($options as $prop => $value) {

            $methodName = 'set' . $filter->filter($prop);

            if (method_exists($this, $methodName)) {
                call_user_func(array(
                    $this,
                    $methodName
                ), $value);
            } else {
                $this->{$prop} = $value;
            }
        }
    }


    public function toArray()
    {
        return array(
            'version' => $this->getVersion(),
            'api-key' => $this->getApiKey(),
            'response-format' => $this->getResponseFormat(),
            'sort-order' => $this->getSortOrder()
        );
    }


    /**
     *
     * @return $version
     */
    public function getVersion()
    {
        return $this->version;
    }


    /**
     *
     * @return $apiKey
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }


    /**
     *
     * @return $responseFormat
     */
    public function getResponseFormat()
    {
        return $this->responseFormat;
    }


    /**
     *
     * @return $offset
     */
    public function getOffset()
    {
        return $this->offset;
    }


    /**
     *
     * @return $sortOrder
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }


    /**
     *
     * @param $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }


    /**
     *
     * @param $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }


    /**
     *
     * @param $responseFormat
     */
    public function setResponseFormat($responseFormat)
    {
        $this->responseFormat = $responseFormat;
    }


    /**
     *
     * @param $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }


    /**
     *
     * @param $sortOrder
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
    }
}