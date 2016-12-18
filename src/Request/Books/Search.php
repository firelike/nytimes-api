<?php
namespace Firelike\NYTimes\Request\Books;


use Firelike\NYTimes\Request\AbstractRequest;

class Search extends AbstractRequest
{

    protected $listName;

    // Optional
    protected $date;

    protected $isbn;

    protected $list;

    protected $publishedDate;

    protected $rank;

    protected $rankLastWeek;

    protected $weeksOnList;

    protected $sortBy;


    public function __construct($args)
    {
        parent::__construct($args);

        parent::setApiKey($args['api-key']);
        parent::setSortOrder($args['sort-order']);
        parent::setOffset($args['offset']);

        if (!isset($args['list-name'])) {
            throw new \Exception('list name is required parameter', '500');
        }
        $this->setListName($args['list-name']);

        if (isset($args['date'])) {
            $this->setDate($args['date']);
        }
        if (isset($args['isbn'])) {
            $this->setIsbn($args['isbn']);
        }

        if (isset($args['list'])) {
            $this->setList($args['list']);
        }
        if (isset($args['published-date'])) {
            $this->setPublishedDate($args['published-date']);
        }
        if (isset($args['rank'])) {
            $this->setRank($args['rank']);
        }
        if (isset($args['rank-last-week'])) {
            $this->setRankLastWeek($args['rank-last-week']);
        }
        if (isset($args['weeks-on-list'])) {
            $this->setWeeksOnList($args['weeks-on-list']);
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
            'isbn' => $this->getIsbn(),
            'list' => $this->getList(),
            'published-date' => $this->getPublishedDate(),
            'rank' => $this->getRank(),
            'rank-last-week' => $this->getRankLastWeek(),
            'weeks-on-list' => $this->getWeeksOnList(),
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
     * @return $isbn
     */
    public function getIsbn()
    {
        return $this->isbn;
    }


    /**
     *
     * @return $list
     */
    public function getList()
    {
        return $this->list;
    }


    /**
     *
     * @return $publishedDate
     */
    public function getPublishedDate()
    {
        return $this->publishedDate;
    }


    /**
     *
     * @return $rank
     */
    public function getRank()
    {
        return $this->rank;
    }


    /**
     *
     * @return $rankLastWeek
     */
    public function getRankLastWeek()
    {
        return $this->rankLastWeek;
    }


    /**
     *
     * @return $weeksOnList
     */
    public function getWeeksOnList()
    {
        return $this->weeksOnList;
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
     * @param $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }


    /**
     *
     * @param $list
     */
    public function setList($list)
    {
        $this->list = $list;
    }


    /**
     *
     * @param $publishedDate
     */
    public function setPublishedDate($publishedDate)
    {
        $this->publishedDate = $publishedDate;
    }


    /**
     *
     * @param $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    }


    /**
     *
     * @param $rankLastWeek
     */
    public function setRankLastWeek($rankLastWeek)
    {
        $this->rankLastWeek = $rankLastWeek;
    }


    /**
     *
     * @param $weeksOnList
     */
    public function setWeeksOnList($weeksOnList)
    {
        $this->weeksOnList = $weeksOnList;
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