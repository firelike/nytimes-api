<?php
namespace Firelike\NYTimes\Request;


abstract class AbstractRequest
{

    /**
     * @var string
     */
    protected $apiKey;

    const SORT_ORDER_ASC = 'ASC';
    const SORT_ORDER_DESC = 'DESC';

    public function toArray()
    {
        return ['api-key' => $this->getApiKey()];
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