<?php
namespace Firelike\NYTimes\Request\Books;

use Firelike\NYTimes\Request\AbstractRequest;

class Reviews extends AbstractRequest
{

    /**
     * @var string
     */
    protected $isbn;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $author;


    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'isbn' => $this->getIsbn(),
            'title' => $this->getTitle(),
            'author' => $this->getAuthor()
        ));
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
     * @return $this
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
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
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * @return $this
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }


}