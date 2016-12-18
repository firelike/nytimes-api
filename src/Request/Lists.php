<?php
namespace Firelike\NYTimes\Request;

class Lists extends AbstractRequest
{

    protected $listName;

    // Optional
    protected $date;

    protected $sortBy;


    /**
     *
     * @param array $args
     * @throws \Exception
     */
    public function __construct($args)
    {
        parent::__construct($args);

        parent::setOptions($args);


        // Zend Form removes all dashes from the form element names
        // therefore the argument keys come without dashes
        if (isset($args['listname'])) {
            $args['list-name'] = $args['listname'];
        }
        if (isset($args['sortby'])) {
            $args['sort-by'] = $args['sortby'];
        }

        // check
        if (!isset($args['list-name'])) {
            throw new \Exception('list name is required parameter', '500');
        }
        // set
        $this->setListName($args['list-name']);

        // set
        if (isset($args['date'])) {
            $this->setDate($args['date']);
        }

        // set
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
     *
     * @return $listName
     */
    public function getListName()
    {
        return $this->listName;
    }


    /**
     *
     * @return $date
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     *
     * @return $sortBy
     */
    public function getSortBy()
    {
        return $this->sortBy;
    }


    /**
     *
     * @param $listName
     */
    public function setListName($listName)
    {
        $this->listName = $listName;
    }


    /**
     *
     * @param $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


    /**
     *
     * @param $sortBy
     */
    public function setSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
    }
}