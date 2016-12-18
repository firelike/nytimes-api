<?php
namespace Firelike\NYTimes;

use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;

class Module implements ConsoleUsageProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }


    public function getConsoleUsage(Console $console)
    {
        return array(
            // Describe available commands
            'nytimes lists [--verbose|-v]' => 'call lists service method',
            'nytimes history [--verbose|-v]' => 'call history method',
            'nytimes list-names [--verbose|-v]' => 'call listNames method',
            'nytimes overview [--verbose|-v]' => 'call overview method',
            'nytimes list-by-date [--verbose|-v]' => 'call listByDate method',
            'nytimes reviews [--verbose|-v]' => 'call reviews method',

            // Describe expected parameters
            array(
                '--verbose|-v',
                '(optional) turn on verbose mode'
            ),
        );
    }
}