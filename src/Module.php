<?php
namespace Firelike\NYTimes;

use Laminas\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Laminas\Console\Adapter\AdapterInterface as Console;

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
            'nytimes lists [--list-name=] [--verbose|-v]' => 'call lists service method',
            'nytimes history [--author=] [--verbose|-v]' => 'call history method',
            'nytimes list-names [--verbose|-v]' => 'call listNames method',
            'nytimes overview [--verbose|-v]' => 'call overview method',
            'nytimes list-by-date [--list-name=] [--date=] [--verbose|-v]' => 'call listByDate method',
            'nytimes reviews [--author=] [--verbose|-v]' => 'call reviews method',

            // Describe expected parameters
            array(
                '--verbose|-v',
                '(optional) turn on verbose mode'
            ),
        );
    }
}