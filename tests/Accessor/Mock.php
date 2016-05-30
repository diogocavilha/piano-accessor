<?php

namespace Tests;

class Mock
{
    use \Piano\AccessorTrait;

    private $nonGetterAndSetter;

    /**
     * @set
     */
    private $nonGetter;

    /**
     * @get
     */
    public $nonSetter;

    /**
     * @set
     * @get
     */
    private $getterAndSetterSimple;

    /**
     * @set stdClass
     * @get
     */
    private $attributeStdClass;

    /**
     * @set Tests\AnyNamespace
     * @get
     */
    private $attributeAnyNamespace;

    /**
     * @set DateTime
     * @get
     */
    private $attributeDateTime;

    /**
     * @get int
     */
    private $intValue = 50;

    /**
     * @get integer
     */
    private $integerValue = 50;

    /**
     * @get bool
     */
    private $boolValue = 50;

    /**
     * @get boolean
     */
    private $booleanValue = 50;

    /**
     * @get float
     */
    private $floatValue = 50;

    /**
     * @get double
     */
    private $doubleValue = 50;

    /**
     * @get string
     */
    private $stringValue = 50;

    /**
     * @get array
     */
    private $arrayValue = 50;

    /**
     * @get object
     */
    private $objectValue = 50;

    /**
     * @set int
     * @get
     */
    private $castInt;

    /**
     * @set integer
     * @get
     */
    private $castInteger;

    /**
     * @set bool
     * @get
     */
    private $castBool;

    /**
     * @set boolean
     * @get
     */
    private $castBoolean;

    /**
     * @set float
     * @get
     */
    private $castFloat;

    /**
     * @set double
     * @get
     */
    private $castDouble;

    /**
     * @set string
     * @get
     */
    private $castString;

    /**
     * @set array
     * @get
     */
    private $castArray;

    /**
     * @set object
     * @get
     */
    private $castObject;
}
