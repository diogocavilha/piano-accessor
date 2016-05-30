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
}
