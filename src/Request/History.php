<?php
namespace Firelike\NYTimes\Request;

class History extends AbstractRequest
{

    protected $ageGroup;

    protected $author;

    protected $contributor;

    protected $isbn;

    protected $price;

    protected $publisher;

    protected $title;

    // Optional 
    protected $sortBy;


    public function __construct($args)
    {
        parent::__construct($args);

        parent::setVersion($args['version']);
        parent::setApiKey($args['api-key']);
        parent::setResponseFormat($args['response-format']);
        parent::setSortOrder($args['sort-order']);
        parent::setOffset($args['offset']);

        if (isset($args['age-group'])) {
            $this->setAgeGroup($args['age-group']);
        }
        if (isset($args['author'])) {
            $this->setAuthor($args['author']);
        }
        if (isset($args['contributor'])) {
            $this->setContributor($args['contributor']);
        }
        if (isset($args['isbn'])) {
            $this->setIsbn($args['isbn']);
        }
        if (isset($args['price'])) {
            $this->setPrice($args['price']);
        }
        if (isset($args['publisher'])) {
            $this->setPublisher($args['publisher']);
        }
        if (isset($args['title'])) {
            $this->setTitle($args['title']);
        }
        if (isset($args['sort-by'])) {
            $this->setSortBy($args['sort-by']);
        }
    }


    public function toArray()
    {

        return array_merge(parent::toArray(), array(
            'list-name' => $this->getListName(),
            'date' => $this->getDate(),
            'sort-by' => $this->getSortBy()
        ));

    }


    /**
     * @return $ageGroup
     */
    public function getAgeGroup()
    {
        return $this->ageGroup;
    }


    /**
     * @return $author
     */
    public function getAuthor()
    {
        return $this->author;
    }


    /**
     * @return $contributor
     */
    public function getContributor()
    {
        return $this->contributor;
    }


    /**
     * @return $isbn
     */
    public function getIsbn()
    {
        return $this->isbn;
    }


    /**
     * @return $price
     */
    public function getPrice()
    {
        return $this->price;
    }


    /**
     * @return $publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }


    /**
     * @return $title
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @return $sortBy
     */
    public function getSortBy()
    {
        return $this->sortBy;
    }


    /**
     * @param $ageGroup
     */
    public function setAgeGroup($ageGroup)
    {
        $this->ageGroup = $ageGroup;
    }


    /**
     * @param $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }


    /**
     * @param $contributor
     */
    public function setContributor($contributor)
    {
        $this->contributor = $contributor;
    }


    /**
     * @param $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }


    /**
     * @param $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }


    /**
     * @param $publisher
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    }


    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


    /**
     * @param $sortBy
     */
    public function setSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
    }


}