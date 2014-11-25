<?php
namespace HtOauthClientModule\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Hrevert\OauthClient\Doctrine\ProviderManager;
use Hrevert\OauthClient\ZendDb\ProviderManager as ZendDbProviderManager;

class ProviderManagerFactory extends AbstractManagerFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \HtOauthClientModule\Options\ModuleOptions $options */
        $options = $serviceLocator->get('HtOauthClientModule\Options\ModuleOptions');

        if ($options->isORM() || $options->isMongoDb()) {
            $objectManager = $this->getObjectManager($serviceLocator);
            $objectRepository = $objectManager->getRepository($options->getProviderClass());

            return new ProviderManager($objectRepository);
        }

        $manager = new ZendDbProviderManager;

        /** @var \Zend\Db\Adapter\Adapter $dbAdapter */
        $dbAdapter = $serviceLocator->get('ht_oauth_client_zend_db_adapter');
        $manager->setDbAdapter($dbAdapter);

        $entityClass = $options->getProviderClass();
        $manager->setEntityPrototype(new $entityClass);

        return $manager;
    }
}
