<?php
namespace HtOauthClientModule\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Hrevert\OauthClient\Doctrine\ProviderManager;

class ProviderManagerFactory extends AbstractManagerFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('HtOauthClientModule\Options\ModuleOptions');

        $objectManager = $this->getObjectManager($serviceLocator);
        $objectRepository = $objectManager->getRepository($options->getProviderClass());

        return new ProviderManager($objectRepository);
    }
}
