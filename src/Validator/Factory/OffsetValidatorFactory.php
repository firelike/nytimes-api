<?php
namespace Firelike\NYTimes\Validator\Factory;


use Firelike\NYTimes\Validator\OffsetValidator;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class OffsetValidatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $sm, $requestedName, array $options = null)
    {
        $validator = new OffsetValidator();
        return $validator;
    }

}