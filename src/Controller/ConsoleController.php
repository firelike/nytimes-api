<?php
namespace Firelike\NYTimes\Controller;

use Zend\Mvc\Console\Controller\AbstractConsoleController;


class ConsoleController extends AbstractConsoleController
{
    /**
     * @var \Firelike\NYTimes\Service\BestSellersService
     */
    protected $service;

    public function listsAction()
    {
        $this->markBegin();

        $options = [];
        $records = $this->getService()->lists($options);
        var_dump($records);

        $this->markEnd();
    }

    public function listNamesAction()
    {
        $this->markBegin();

        $options = [];
        $records = $this->getService()->listNames($options);
        var_dump($records);


        $this->markEnd();
    }


    public function markBegin()
    {
        $this->getConsole()->writeLine('============== BEGIN ==============');
    }

    public function markEnd()
    {
        $request = $this->getRequest();
        $verbose = $request->getParam('verbose') || $request->getParam('v');

        if ($verbose) {
            $this->getConsole()->writeLine("Done");
        }

        $this->getConsole()->writeLine('============== END ==============');
    }

    /**
     * @return \Firelike\NYTimes\Service\BestSellersService
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param \Firelike\NYTimes\Service\BestSellersService $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }


}

