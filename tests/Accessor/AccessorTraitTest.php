<?php

namespace Tests;

use Tests\Mock;

class AccessorTraitTest extends \PHPUnit_Framework_TestCase
{
    private $mock;

    public function setUp()
    {
        $this->mock = new Mock();
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function itMustNotCreateGetterWhenThereIsNoAnnotation()
    {
        $this->mock->setNonGetter('test');
        $this->mock->getNonGetter();
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function itMustNotCreateSetterWhenThereIsNoAnnotation()
    {
        $expected = 'foo';
        $this->mock->nonSetter = $expected;
        $this->assertEquals($expected, $this->mock->getNonSetter());
        $this->mock->setNonSetter('bar');
    }

    /**
     * @test
     */
    public function itCanCreateSimpleGetterAndSetter()
    {
        $this->mock->setGetterAndSetterSimple('test');
        $this->assertEquals('test', $this->mock->getGetterAndSetterSimple(), 'Expected value must be test');
    }

    /**
     * @test
     */
    public function itCanCreateGetterAndSetterWithTypeHint()
    {
        $expectedNamespace = '\stdClass';
        $expected = new $expectedNamespace();
        $this->mock->setAttributeStdClass($expected);
        $this->assertInstanceOf($expectedNamespace, $this->mock->getAttributeStdClass(), 'Expected value must be ' . $expectedNamespace);
    }

    /**
     * @test
     */
    public function itCanCreateSetterForAnyNamespaceAsHint()
    {
        $expectedNamespace = '\Tests\AnyNamespace';
        $expected = new $expectedNamespace();
        $this->mock->setAttributeAnyNamespace($expected);
        $this->assertInstanceOf($expectedNamespace, $this->mock->getAttributeAnyNamespace(), 'Expected value must be ' . $expectedNamespace);
    }

    /**
     * @test
     */
    public function itCanCreateSetterForDateTime()
    {
        $expectedNamespace = '\DateTime';
        $expected = new $expectedNamespace();
        $this->mock->setAttributeDateTime($expected);
        $this->assertInstanceOf($expectedNamespace, $this->mock->getAttributeDateTime(), 'Expected value must be ' . $expectedNamespace);
    }

    /**
     * @test
     */
    public function itCanRunTypeCastBeforeReturningAValue()
    {
        $this->assertInternalType('int', $this->mock->getIntValue(), 'Value must be int');
        $this->assertInternalType('integer', $this->mock->getIntegerValue(), 'Value must be integer');
        $this->assertInternalType('bool', $this->mock->getBoolValue(), 'Value must be bool');
        $this->assertInternalType('boolean', $this->mock->getBooleanValue(), 'Value must be boolean');
        $this->assertInternalType('float', $this->mock->getFloatValue(), 'Value must be float');
        $this->assertInternalType('double', $this->mock->getDoubleValue(), 'Value must be double');
        $this->assertInternalType('string', $this->mock->getStringValue(), 'Value must be string');
        $this->assertInternalType('array', $this->mock->getArrayValue(), 'Value must be array');
        $this->assertInternalType('object', $this->mock->getObjectValue(), 'Value must be object');
    }
}
