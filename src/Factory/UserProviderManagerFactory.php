<?php
namespace HtOauthClientModule\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Hrevert\OauthClient\Doctrine\UserProviderManager;
use Hrevert\OauthClient\ZendDb\UserProviderManager as ZendDbUserProviderManager;

class UserProviderManagerFactory extends AbstractManagerFactory
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \HtOauthClientModule\Options\ModuleOptions $options */
        $options = $serviceLocator->get('HtOauthClientModule\Options\ModuleOptions');
        if ($options->isORM() || $options->isMongoDb()) {
            $objectManager = $this->getObjectManager($serviceLocator);

            return new UserProviderManager($objectManager, $options->getUserProviderClass());
        }

        /** @var \Hrevert\OauthClient\ZendDb\ProviderManager $providerManager */
        $providerManager = $serviceLocator->get('Hrevert\OauthClient\Manager\ProviderManager');
        /** @var \Hrevert\OauthClient\Manager\UserManagerInterface $userManager */
        $userManager = $serviceLocator->get('Hrevert\OauthClient\Manager\UserManager');

        $manager = new ZendDbUserProviderManager($providerManager, $userManager);

        /** @var \Zend\Db\Adapter\Adapter $dbAdapter */
        $dbAdapter = $serviceLocator->get('ht_oauth_client_zend_db_adapter');
        $manager->setDbAdapter($dbAdapter);

        $entityClass = $options->getUserProviderClass();
        $manager->setEntityPrototype(new $entityClass);

        return $manager;
    }
}
