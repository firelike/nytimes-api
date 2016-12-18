<?php
namespace Firelike\NYTimes\Response\Books;


class BestSellerHistory
{

    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var string
     */
    protected $contributor;
    /**
     * @var string
     */
    protected $author;
    /**
     * @var string
     */
    protected $contributor_note;
    /**
     * @var integer
     */
    protected $price;
    /**
     * @var string
     */
    protected $age_group;
    /**
     * @var string
     */
    protected $publisher;
    /**
     * @var array
     */
    protected $isbns = [];
    /**
     * @var array
     */
    protected $ranks_history = [];
    /**
     * @var array
     */
    protected $reviews = [];

}