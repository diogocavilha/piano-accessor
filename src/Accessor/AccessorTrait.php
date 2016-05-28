<?php

namespace Piano;

use Closure;
use ReflectionClass;
use ReflectionProperty;

/**
 * This trait allows us to generate authomatic getters and setters only by using simple annotations.
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
trait AccessorTrait
{
    private $methods = [];

    public function __construct()
    {
        $annotations = $this->getAnnotations();

        foreach ($annotations as $attribute => $doc) {
            $this->createSetter($attribute, $doc);
            $this->createGetter($attribute, $doc);
        }
    }

    public function __call($method, $args)
    {
        if (isset($this->methods[$method]) && is_callable($this->methods[$method])) {
            return call_user_func_array($this->methods[$method], $args);
        }
    }

    private function createSetter($attribute, $doc)
    {
        if (!$this->canSet($doc)) {
            return;
        }

        $newMethod = function ($param) use ($attribute) {
            $this->$attribute = $param;
        };

        $method = 'set' . ucfirst($attribute);
        $this->methods[$method] = Closure::bind($newMethod, $this, get_class());
    }

    private function createGetter($attribute, $doc)
    {
        if (!$this->canGet($doc)) {
            return;
        }

        $newMethod = function () use ($attribute) {
            return $this->$attribute;
        };

        $method = 'get' . ucfirst($attribute);
        $this->methods[$method] = Closure::bind($newMethod, $this, get_class());
    }

    private function getAnnotations()
    {
        $annotations = [];
        $properties = (new ReflectionClass(get_class($this)))->getProperties();
        foreach ($properties as $property) {
            $annotations[$property->name] = (new ReflectionProperty(get_class($this), $property->name))->getDocComment();
        }

        return $annotations;
    }

    private function canSet($doc)
    {
        preg_match('/@set/', $doc, $matches);
        return count($matches) >= 1;
    }

    private function canGet($doc)
    {
        preg_match('/@get/', $doc, $matches);
        return count($matches) >= 1;
    }
}
