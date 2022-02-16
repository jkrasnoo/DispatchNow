<?php

declare(strict_types=1);

namespace Application\Controller;

use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class RegistrationController extends AbstractActionController
{
    private ContainerInterface $container;
    private ?array $options;

    public function __construct(ContainerInterface $container, ?array $options = array())
    {
        $this->container = $container;
        $this->options = $options;
    }

    public function indexAction() : ViewModel
    {
        $serviceManager = $this->getServiceManager();
        $writeDbAdapter = $serviceManager->get('Application\Db\WriteAdapter');
        var_dump($writeDbAdapter);
        return new ViewModel();
    }

    private function getServiceManager() : ContainerInterface
    {
        return $this->container;
    }

    private function getOptions() : ?array
    {
        return $this->options;
    }
}
