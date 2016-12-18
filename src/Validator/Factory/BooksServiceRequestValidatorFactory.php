<?php
namespace Firelike\NYTimes\Validator\Factory;


use Firelike\NYTimes\Validator\BooksServiceRequestValidator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class BooksServiceRequestValidatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        $validator = new BooksServiceRequestValidator();
        $validator->setSortOrderValidator($sm->get('Firelike\ShareASale\Validator\SortOrderValidator'));
        $validator->setOffsetValidator($sm->get('Firelike\ShareASale\Validator\OffsetValidator'));
        return $validator;
    }

}