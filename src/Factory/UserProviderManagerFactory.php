<?php
namespace HtOauthClientModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Hrevert\OauthClient\Doctrine\UserProviderManager;

class UserProviderManagerFactory extends AbstractManagerFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('HtOauthClientModule\Options\ModuleOptions');

        $objectManager = $this->getObjectManager($serviceLocator);

        return new UserProviderManager($objectManager, $options->getUserProviderClass());
    }
}
