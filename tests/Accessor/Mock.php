<?php

namespace Tests;

class Mock
{
    use \Piano\AccessorTrait;

    /**
     * @set
     * @get
     */
    private $getterAndSetterSimple;

    private $nonGetterAndSetter;
}
