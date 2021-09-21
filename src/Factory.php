<?php

declare(strict_types=1);

namespace Lightfoot;

use ReflectionClass;
use Exception;

/**
 * Factory
 */
class Factory
{
    /**
     * instances
     */
    protected static array $instances = [];

    /**
     * construct
     */
    public function __construct()
    {
        self::$instances[self::class] = $this;
    }

    /**
     * getInstance
     *
     * @param string $class
     * @return object
     */
    public function getInstance(string $class): object
    {
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = '__in_progress__';
            $args = [];
            if ($constructor = (new ReflectionClass($class))->getConstructor()) {
                foreach ($constructor->getParameters() as $param) {
                    $args[] = $this->getInstance($param->getType()->getName());
                }
            }
            self::$instances[$class] = new $class(...$args);
        }
        if (self::$instances[$class] === '__in_progress__') {
            $path = [];
            foreach (self::$instances as $clazz => $instance) {
                if ($instance === '__in_progress__') {
                    $path[] = $clazz;
                }
            }
            throw new Exception('Circular dependency: ' . implode(' -> ', $path) . ' -> *recursion*');
        }
        return self::$instances[$class];
    }
}
