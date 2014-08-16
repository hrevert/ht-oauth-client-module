<?php
namespace HtOauthClientModule\Options;

use Zend\Stdlib\AbstractOptions;
use HtOauthClientModule\Exception;

class ModuleOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $driver = 'orm';
 
     /**
     * @var array
     */   
    protected static $allowedDrivers = ['orm', 'mongodb'];

    /**
     * @var string
     */
    protected $providerClass = 'Hrevert\OauthClient\Entity\Provider';

    /**
     * @var string
     */
    protected $userProviderClass = 'Hrevert\OauthClient\Entity\UserProvider';

    /**
     * Sets driver
     *
     * @param string $driver
     * @return self
     */
    public function setDriver($driver)
    {
        $driver = strtolower($driver);

        if (!in_array($driver, self::$allowedDrivers)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s expects argument 1 to be one of %s, %s provided instead',
                __METHOD__,
                implode(',', self::$allowedDrivers),
                $driver
            ));
        }

        $this->driver = $driver;

        return $this;
    }

    /**
     * Gets driver
     *
     * @return string
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Checks if driver is orm
     *
     * @return bool
     */
    public function isORM()
    {
        return $this->driver == 'orm';
    }

    /**
     * Checks if driver is mongodb
     *
     * @return bool
     */
    public function isMongoDb()
    {
        return $this->driver == 'mongodb';
    }

    /**
     * Sets providerClass
     *
     * @param string $providerClass
     * @return self
     */
    public function setProviderClass($providerClass)
    {
        $this->providerClass = $providerClass;

        return $this;        
    }

    /**
     * Gets providerClass
     *
     * @return string
     */
    public function getProviderClass()
    {
        return $this->providerClass;
    }

    /**
     * Sets userProviderClass
     *
     * @param string $userProviderClass
     * @return self
     */
    public function setUserProviderClass($userProviderClass)
    {
        $this->userProviderClass = $userProviderClass;

        return $this;        
    }

    /**
     * Gets userProviderClass
     *
     * @return string
     */
    public function getUserProviderClass()
    {
        return $this->userProviderClass;
    }
}
