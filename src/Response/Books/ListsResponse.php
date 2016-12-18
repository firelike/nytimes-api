<?php
namespace Firelike\NYTimes\Response\Books;


class ListsResponse
{
    /**
     * @var string
     */
    protected $status;
    /**
     * @var string
     */
    protected $copyright;
    /**
     * @var integer
     */
    protected $num_results;
    /**
     * @var string
     */
    protected $last_modified;
    /**
     * @var array
     */
    protected $results = [];
}