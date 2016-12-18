<?php
namespace Firelike\NYTimes\Validator;


use Zend\Validator\AbstractValidator;
use Zend\Validator\InArray;

class SortOrderValidator extends AbstractValidator
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value)
    {
        $inArrayValidator = new InArray();

        $haystack = [
            'ASC',
            'DESC'
        ];
        $inArrayValidator->setHaystack($haystack);

        if (!$inArrayValidator->isValid($value)) {
            $this->setMessage(sprintf('invalid sort order provided: %s. expecting %s', $value, implode(' or ', $haystack)));
            return false;
        }

        return true;
    }
}