<?php
namespace Firelike\NYTimes\Validator;


use Zend\Validator\AbstractValidator;

class BooksServiceRequestValidator extends AbstractValidator
{
    /**
     * @var SortOrderValidator
     */
    protected $sortOrderValidator;

    /**
     * @var OffsetValidator
     */
    protected $offsetValidator;

    /**
     * @param mixed $request
     * @return bool
     */
    public function isValid($request)
    {
        if ($request instanceof \Firelike\NYTimes\Request\AbstractRequest) {
            return false;
        }

        if (method_exists($request, 'getSortOrder')) {
            if ($request->getSortOrder()) {
                $validator = $this->getSortOrderValidator();
                if (!$validator->isValid($request->getSortOrder())) {
                    $this->setMessage('Invalid sort order');
                    return false;
                }
            }
        }

        if (method_exists($request, 'getOffset')) {
            if ($request->getOffset()) {
                $validator = $this->getOffsetValidator();
                if (!$validator->isValid($request->getOffset())) {
                    $this->setMessage('Invalid offset');
                    return false;
                }
            }
        }

        if (method_exists($request, 'getIsbn')) {
            if ($request->getIsbn()) {
                $validator = new \Zend\Validator\Isbn\Isbn13();
                if (!$validator->isValid($request->getIsbn())) {
                    $this->setMessage('Invalid ISBN-13');
                    return false;
                }
            }
        }


        return true;
    }

    /**
     * @return SortOrderValidator
     */
    public function getSortOrderValidator()
    {
        return $this->sortOrderValidator;
    }

    /**
     * @param SortOrderValidator $sortOrderValidator
     */
    public function setSortOrderValidator($sortOrderValidator)
    {
        $this->sortOrderValidator = $sortOrderValidator;
    }

    /**
     * @return OffsetValidator
     */
    public function getOffsetValidator()
    {
        return $this->offsetValidator;
    }

    /**
     * @param OffsetValidator $offsetValidator
     */
    public function setOffsetValidator($offsetValidator)
    {
        $this->offsetValidator = $offsetValidator;
    }


}