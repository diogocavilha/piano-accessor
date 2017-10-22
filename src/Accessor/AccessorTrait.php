<?php

namespace Piano;

/**
 * This trait allows us to generate authomatic getters and setters only by using simple annotations.
 *
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
trait AccessorTrait
{
    private $methods = [];
    private $supportedTypes = [
        'int',
        'integer',
        'bool',
        'boolean',
        'float',
        'double',
        'string',
        'array',
        'object',
    ];

    public function __call($method, $args)
    {
        $this->createMethods();

        if (isset($this->methods[$method]) && is_callable($this->methods[$method])) {
            return call_user_func_array($this->methods[$method], $args);
        }

        throw new \Exception(
            sprintf(
                'Call to undefined method %s::%s()',
                get_class($this),
                $method
            )
        );
    }

    final private function createMethods()
    {
        $annotations = $this->getAnnotations();

        foreach ($annotations as $attribute => $doc) {
            $this->createSetter($attribute, $doc);
            $this->createGetter($attribute, $doc);
        }
    }

    final private function createSetter($attribute, $doc)
    {
        if (!$this->canSet($doc)) {
            return;
        }

        $hint = $this->getHint($doc);
        $method = 'set' . ucfirst($attribute);

        $closure = function ($param) use ($attribute, $hint, $method) {
            if (!is_null($hint) && !($param instanceof $hint) && !in_array($hint, $this->supportedTypes)) {
                throw new \Exception(
                    sprintf(
                        'Argument 1 passed to %s::%s must be an instance of %s, %s given',
                        __CLASS__,
                        $method,
                        $hint,
                        is_object($param) ? get_class($param) : gettype($param)
                    )
                );
            }

            if (in_array($hint, $this->supportedTypes)) {
                settype($param, $hint);
            }

            $this->$attribute = $param;
        };

        $this->addClosure($method, $closure);
    }

    final private function createGetter($attribute, $doc)
    {
        if (!$this->canGet($doc)) {
            return;
        }

        $method = 'get' . ucfirst($attribute);
        $typeCast = $this->getTypeCastToReturn($doc);

        $closure = function () use ($attribute, $typeCast) {
            if (!is_null($typeCast)) {
                settype($this->$attribute, $typeCast);
            }

            return $this->$attribute;
        };

        $this->addClosure($method, $closure);
    }

    final private function addClosure($method, $closure)
    {
        $this->methods[$method] = \Closure::bind($closure, $this, get_class());
    }

    final private function getAnnotations()
    {
        $annotations = [];
        $properties = (new \ReflectionClass(get_class($this)))->getProperties();
        foreach ($properties as $property) {
            $annotations[$property->name] = (new \ReflectionProperty(get_class($this), $property->name))->getDocComment();
        }

        return $annotations;
    }

    final private function canSet($doc)
    {
        preg_match('/@set/', $doc, $matches);
        return count($matches) >= 1;
    }

    final private function canGet($doc)
    {
        preg_match('/@get/', $doc, $matches);
        return count($matches) >= 1;
    }

    final private function getHint($doc)
    {
        preg_match('/@set.*/', $doc, $matches);

        $annotationParts = explode(' ', $matches[0]);

        if (count($annotationParts) > 1) {
            return $annotationParts[1];
        }

        return null;
    }

    final private function getTypeCastToReturn($doc)
    {
        preg_match('/@get.*/', $doc, $matches);

        $annotationParts = explode(' ', $matches[0]);

        $type = null;

        if (count($annotationParts) > 1) {
            $type = $annotationParts[1];
        }

        if (!is_null($type) && !in_array($type, $this->supportedTypes)) {
            throw new \Exception(sprintf('%s is not a valid type', $type));
        }

        return $type;
    }
}
