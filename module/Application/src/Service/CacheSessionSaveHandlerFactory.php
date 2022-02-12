<?php

declare(strict_types=1);

namespace Application\Service;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\Session\SaveHandler\SaveHandlerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\Session\SaveHandler\Cache;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Laminas\Cache\Service\StorageAdapterFactoryInterface;

/**
 * Session save handler cache factory.
 */
class CacheSessionSaveHandlerFactory implements FactoryInterface
{
    const CONFIG_KEY = 'session_save_handler';

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('Config');
        if (! isset($config[self::CONFIG_KEY]))
        {
            throw new ServiceNotCreatedException(
                'Cache session save handler requires ' . self::CONFIG_KEY . ' to be set.'
            );
        }

        $sessionSaveHandlerConfig = $config[self::CONFIG_KEY];
        if (! isset($sessionSaveHandlerConfig['cache']))
        {
            throw new ServiceNotCreatedException(
                'Cache session save handler requires \'cache\' to be set.'
            );
        }

        $cacheService = $sessionSaveHandlerConfig['cache'];

        $cache = null;

        if (is_string($cacheService))
        {
            if (! $container->has($cacheService))
            {
                throw new ServiceNotCreatedException(sprintf(
                    'Cache service with the name %s not found.',
                    $cacheService
                ));
            }

            $cache = $container->get($cacheService);
        }

        if (is_array($cacheService))
        {
            $storageFactory = $container->get(StorageAdapterFactoryInterface::class);
            $cache = $storageFactory->createFromArrayConfiguration($cacheService);
        }

        return new Cache($cache);

    }

    /**
     * Creates the Cache Session Save Handler as a service.
     *
     * @throws ContainerException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, SaveHandlerInterface::class);
    }
}