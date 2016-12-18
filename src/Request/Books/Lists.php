<?php
namespace Firelike\NYTimes\Request\Books;

use Firelike\NYTimes\Request\AbstractRequest;

class Lists extends AbstractRequest
{

    /**
     * @var string
     */
    protected $list;

    /**
     * @var integer
     */
    protected $weeksOnList;

    /**
     * @var \DateTime
     */
    protected $bestsellersDate;

    /**
     * @var string
     */
    protected $date;
    /**
     * @var string
     */
    protected $isbn;
    /**
     * @var string
     */
    protected $publishedDate;
    /**
     * @var integer
     */
    protected $rank;
    /**
     * @var integer
     */
    protected $rankLastWeek;
    /**
     * @var integer
     */
    protected $offset;
    /**
     * @var string
     */
    protected $sortOrder;


    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'list' => $this->getList(),
            'weeks-on-list' => $this->getWeeksOnList(),
            'bestsellers-date' => $this->getBestsellersDate(),
            'date' => $this->getDate(),
            'isbn' => $this->getIsbn(),
            'published-date' => $this->getPublishedDate(),
            'rank' => $this->getRank(),
            'rank-last-week' => $this->getRankLastWeek(),
            'offset' => $this->getOffset(),
            'sort-order' => $this->getSortOrder()
        ));
    }

    /**
     * @return string
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param string $list
     * @return $this
     */
    public function setList($list)
    {
        $this->list = $list;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeeksOnList()
    {
        return $this->weeksOnList;
    }

    /**
     * @param int $weeksOnList
     * @return $this
     */
    public function setWeeksOnList($weeksOnList)
    {
        $this->weeksOnList = $weeksOnList;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBestsellersDate()
    {
        return $this->bestsellersDate;
    }

    /**
     * @param \DateTime $bestsellersDate
     * @return $this
     */
    public function setBestsellersDate($bestsellersDate)
    {
        $this->bestsellersDate = $bestsellersDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
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
    public function getPublishedDate()
    {
        return $this->publishedDate;
    }

    /**
     * @param string $publishedDate
     * @return $this
     */
    public function setPublishedDate($publishedDate)
    {
        $this->publishedDate = $publishedDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param int $rank
     * @return $this
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
        return $this;
    }

    /**
     * @return int
     */
    public function getRankLastWeek()
    {
        return $this->rankLastWeek;
    }

    /**
     * @param int $rankLastWeek
     * @return $this
     */
    public function setRankLastWeek($rankLastWeek)
    {
        $this->rankLastWeek = $rankLastWeek;
        return $this;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return string
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param string $sortOrder
     * @return $this
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
        return $this;
    }


}