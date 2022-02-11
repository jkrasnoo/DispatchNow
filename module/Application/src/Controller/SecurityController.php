<?php

declare(strict_types=1);

namespace Application\Controller;

use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;




class SecurityController extends AbstractActionController
{
    private ContainerInterface $container;
    private ?array $options;

    public function __construct(ContainerInterface $container, ?array $options = null)
    {
        $this->container = $container;
        $this->options = $options;
    }

    public function loginAction() : ViewModel
    {
        $serviceManager = $this->getServiceManager();

        return new ViewModel();
    }

    public function logoutAction() : ViewModel
    {
        return new ViewModel();
    }

    public function resetpwAction() : ViewModel
    {
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