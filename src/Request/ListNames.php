<?php
namespace Firelike\NYTimes\Request;


class ListNames extends AbstractRequest
{


    public function __construct($args)
    {
        parent::__construct($args);

        parent::setOptions($args);
    }
}