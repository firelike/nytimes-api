<?php
namespace Firelike\NYTimes\Request\Books;

use Firelike\NYTimes\Request\AbstractRequest;

class History extends AbstractRequest
{

    /**
     * @var string
     */
    protected $ageGroup;

    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $contributor;

    /**
     * @var string
     */
    protected $isbn;

    /**
     * @var string
     */
    protected $price;

    /**
     * @var string
     */
    protected $publisher;

    /**
     * @var string
     */
    protected $title;


    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'age-group' => $this->getAuthor(),
            'author' => $this->getAuthor(),
            'contributor' => $this->getContributor(),
            'isbn' => $this->getIsbn(),
            'price' => $this->getPrice(),
            'publisher' => $this->getPublisher(),
            'title' => $this->getTitle(),
        ));

    }

    /**
     * @return string
     */
    public function getAgeGroup()
    {
        return $this->ageGroup;
    }

    /**
     * @param string $ageGroup
     * @return History
     */
    public function setAgeGroup($ageGroup)
    {
        $this->ageGroup = $ageGroup;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return History
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getContributor()
    {
        return $this->contributor;
    }

    /**
     * @param string $contributor
     * @return History
     */
    public function setContributor($contributor)
    {
        $this->contributor = $contributor;
        return $this;
    }

    /**
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     * @return History
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return History
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param string $publisher
     * @return History
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return History
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }


}