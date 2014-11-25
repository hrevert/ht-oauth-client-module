<?php

return [
    'ht_oauth_client' => [],
    'service_manager' => [
        'factories' => [
            'HtOauthClientModule\Options\ModuleOptions' => 'HtOauthClientModule\Factory\ModuleOptionsFactory',
            'Hrevert\OauthClient\Manager\UserProviderManager' => 'HtOauthClientModule\Factory\UserProviderManagerFactory',
            'Hrevert\OauthClient\Manager\ProviderManager' => 'HtOauthClientModule\Factory\ProviderManagerFactory',
        ],
        'aliases' => [
            // Doctrine Entity Manager
            'ht_oauth_client_doctrine_em' => 'Doctrine\ORM\EntityManager',

            // Doctrine Mongodb
            'ht_oauth_client_doctrine_dm' => 'doctrine.documentmanager.odm_default',

            // Zend\Db
            'ht_oauth_client_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'ht_oauth_client_models' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/../../ht-oauth-client/config/doctrine/orm/models',
            ],
            'ht_oauth_client_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/../../ht-oauth-client/config/doctrine/orm/entities',
            ],
            'orm_default' => [
                'drivers' => [
                    'Hrevert\OauthClient\Model' => 'ht_oauth_client_models',
                    'Hrevert\OauthClient\Entity' => 'ht_oauth_client_entities',
                ],
            ],
        ],
    ],
];
