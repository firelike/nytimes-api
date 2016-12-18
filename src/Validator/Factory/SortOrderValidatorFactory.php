<?php
namespace Firelike\NYTimes\Validator\Factory;


use Firelike\NYTimes\Validator\SortOrderValidator;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SortOrderValidatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        $validator = new SortOrderValidator();
        return $validator;
    }

}