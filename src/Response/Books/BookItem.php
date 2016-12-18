<?php
namespace Firelike\NYTimes\Response\Books;


class BookItem
{
    /**
     * @var string
     */
    protected $list_name;
    /**
     * @var string
     */
    protected $display_name;
    /**
     * @var string
     */
    protected $bestsellers_date;
    /**
     * @var string
     */
    protected $published_date;
    /**
     * @var integer
     */
    protected $rank;
    /**
     * @var integer
     */
    protected $rank_last_week;
    /**
     * @var integer
     */
    protected $weeks_on_list;
    /**
     * @var integer
     */
    protected $asterisk;
    /**
     * @var integer
     */
    protected $dagger;
    /**
     * @var string
     */
    protected $amazon_product_url;
    /**
     * @var array
     */
    protected $isbns = [];
    /**
     * @var array
     */
    protected $book_details = [];
    /**
     * @var array
     */
    protected $reviews = [];

}