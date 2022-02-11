<?php

declare(strict_types=1);

namespace Application;

use Laminas\Mvc\MvcEvent;
use Laminas\Session\SessionManager;
use Laminas\Session\Container;
use Laminas\Session\Validator;

class Module
{
    public function getConfig(): array
    {
        /** @var array $config */
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }

    public function onBootstrap(MvcEvent $e)
    {
        $this->bootstrapSession($e);
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function bootstrapSession(MvcEvent $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();

        $session = $serviceManager->get(SessionManager::class);
        $session->start();

        $container = new Container('initialized');

        /**
        if (isset($container->init))
        {
            return;
        }
        */

        $request = $e->getApplication()->getRequest();
        $server = $request->getServer();

        $session->regenerateId(true);
        $container->init = true;
        $container->remoteAddr = $server->get('REMOTE_ADDR');
        $container->httpUserAgent = $server->get('HTTP_USER_AGENT');

        $config = $serviceManager->get('Config');

        if (! isset($config['session']))
        {
            return;
        }

        $sessionConfig = $config['session'];

        if (! isset($sessionConfig['validators']))
        {
            return;
        }

        $chain   = $session->getValidatorChain();

        foreach ($sessionConfig['validators'] as $validator)
        {
            $name = explode('\\', $validator);
            $name = lcfirst($name[array_key_last($name)]);

            $validator = (isset($container->$name)) ? new $validator($container->$name) : new $validator();

            $chain->attach('session.validate', array($validator, 'isValid'));
        }
    }

    public function getServiceConfig()
    {
        return [

        ];
    }
}
