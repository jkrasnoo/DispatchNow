<?php

declare(strict_types=1);

namespace Application\Controller;

use Interop\Container\ContainerInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class DashboardController extends AbstractActionController
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
