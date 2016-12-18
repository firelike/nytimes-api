<?php
namespace Firelike\NYTimes\Validator;


use Zend\Validator\AbstractValidator;
use Zend\Validator\Callback;

class OffsetValidator extends AbstractValidator
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {

        $validator = new Callback(function ($value) {
            return ($value % 20) == 0;
        });

        if (!$validator->isValid($value)) {
            $this->setMessage(sprintf('offset should be multiple of paging size 20. provided:%s', $value));
            return false;
        }

        return true;
    }
}