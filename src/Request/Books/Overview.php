<?php
namespace Firelike\NYTimes\Request\Books;

use Firelike\NYTimes\Request\AbstractRequest;

class Overview extends AbstractRequest
{

    /**
     * @var string
     */
    protected $publishedDate;

    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'published_date' => $this->getPublishedDate(),
        ));

    }

    /**
     * @return string
     */
    public function getPublishedDate()
    {
        return $this->publishedDate;
    }

    /**
     * @param string $publishedDate
     */
    public function setPublishedDate($publishedDate)
    {
        $this->publishedDate = $publishedDate;
    }


}