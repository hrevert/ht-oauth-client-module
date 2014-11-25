<?php
namespace HtOauthClientModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractManagerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    protected function getObjectManager(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('HtOauthClientModule\Options\ModuleOptions');

        if ($options->isORM()) {
            return $serviceLocator->get('ht_oauth_client_doctrine_em');
        } else {
            return $serviceLocator->get('ht_oauth_client_doctrine_dm');
        }
    }
}
