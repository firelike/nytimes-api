<?php
namespace Firelike\NYTimes\Validator\Factory;


use Firelike\NYTimes\Validator\BooksServiceRequestValidator;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class BooksServiceRequestValidatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        $validator = new BooksServiceRequestValidator();
        $validator->setSortOrderValidator($sm->get('Firelike\NYTimes\Validator\SortOrderValidator'));
        $validator->setOffsetValidator($sm->get('Firelike\NYTimes\Validator\OffsetValidator'));
        return $validator;
    }

}