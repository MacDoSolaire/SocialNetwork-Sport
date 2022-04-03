<?php

namespace Container6C2J3wd;
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'persistence'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'Persistence'.\DIRECTORY_SEPARATOR.'ObjectManager.php';
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'orm'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'ORM'.\DIRECTORY_SEPARATOR.'EntityManagerInterface.php';
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'orm'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'ORM'.\DIRECTORY_SEPARATOR.'EntityManager.php';

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
     */
    private $valueHolderfddc8 = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializerf3095 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties008f7 = [
        
    ];

    public function getConnection()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getConnection', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getMetadataFactory', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getExpressionBuilder', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'beginTransaction', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->beginTransaction();
    }

    public function getCache()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getCache', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getCache();
    }

    public function transactional($func)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'transactional', array('func' => $func), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->transactional($func);
    }

    public function commit()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'commit', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->commit();
    }

    public function rollback()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'rollback', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getClassMetadata', array('className' => $className), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'createQuery', array('dql' => $dql), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'createNamedQuery', array('name' => $name), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'createQueryBuilder', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'flush', array('entity' => $entity), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'clear', array('entityName' => $entityName), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->clear($entityName);
    }

    public function close()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'close', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->close();
    }

    public function persist($entity)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'persist', array('entity' => $entity), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'remove', array('entity' => $entity), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'refresh', array('entity' => $entity), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'detach', array('entity' => $entity), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'merge', array('entity' => $entity), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getRepository', array('entityName' => $entityName), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'contains', array('entity' => $entity), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getEventManager', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getConfiguration', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'isOpen', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getUnitOfWork', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getProxyFactory', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'initializeObject', array('obj' => $obj), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'getFilters', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'isFiltersStateClean', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'hasFilters', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return $this->valueHolderfddc8->hasFilters();
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializerf3095 = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHolderfddc8) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolderfddc8 = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolderfddc8->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, '__get', ['name' => $name], $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        if (isset(self::$publicProperties008f7[$name])) {
            return $this->valueHolderfddc8->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderfddc8;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolderfddc8;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, '__set', array('name' => $name, 'value' => $value), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderfddc8;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolderfddc8;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, '__isset', array('name' => $name), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderfddc8;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolderfddc8;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, '__unset', array('name' => $name), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderfddc8;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolderfddc8;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, '__clone', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        $this->valueHolderfddc8 = clone $this->valueHolderfddc8;
    }

    public function __sleep()
    {
        $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, '__sleep', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;

        return array('valueHolderfddc8');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializerf3095 = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializerf3095;
    }

    public function initializeProxy() : bool
    {
        return $this->initializerf3095 && ($this->initializerf3095->__invoke($valueHolderfddc8, $this, 'initializeProxy', array(), $this->initializerf3095) || 1) && $this->valueHolderfddc8 = $valueHolderfddc8;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolderfddc8;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolderfddc8;
    }
}

if (!\class_exists('EntityManager_9a5be93', false)) {
    \class_alias(__NAMESPACE__.'\\EntityManager_9a5be93', 'EntityManager_9a5be93', false);
}
