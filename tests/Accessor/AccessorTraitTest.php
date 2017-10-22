<?php

namespace Tests\Acessor;

use Tests\Mock;

class AccessorTraitTest extends \PHPUnit\Framework\TestCase
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

    /**
     * @test
     */
    public function itCanRunTypeCastIntBeforeSettingAValue()
    {
        $this->mock->setCastInt('50');
        $this->assertSame(50, $this->mock->getCastInt());
        $this->assertInternalType('int', $this->mock->getCastInt(), 'Value must be int');
    }

    /**
     * @test
     */
    public function itCanRunTypeCastIntegerBeforeSettingAValue()
    {
        $this->mock->setCastInteger('50');
        $this->assertSame(50, $this->mock->getCastInteger());
        $this->assertInternalType('integer', $this->mock->getCastInteger(), 'Value must be integer');
    }

    /**
     * @test
     */
    public function itCanRunTypeCastBoolBeforeSettingAValue()
    {
        $this->mock->setCastBool('50');
        $this->assertSame(true, $this->mock->getCastBool());
        $this->assertInternalType('bool', $this->mock->getCastBool(), 'Value must be bool');
    }

    /**
     * @test
     */
    public function itCanRunTypeCastBooleanBeforeSettingAValue()
    {
        $this->mock->setCastBoolean('50');
        $this->assertSame(true, $this->mock->getCastBoolean());
        $this->assertInternalType('boolean', $this->mock->getCastBoolean(), 'Value must be boolean');
    }

    /**
     * @test
     */
    public function itCanRunTypeCastFloatBeforeSettingAValue()
    {
        $this->mock->setCastFloat('50');
        $this->assertSame((float) 50, $this->mock->getCastFloat());
        $this->assertInternalType('float', $this->mock->getCastFloat(), 'Value must be float');
    }

    /**
     * @test
     */
    public function itCanRunTypeCastDoubleBeforeSettingAValue()
    {
        $this->mock->setCastDouble('50');
        $this->assertSame((double) 50, $this->mock->getCastDouble());
        $this->assertInternalType('double', $this->mock->getCastDouble(), 'Value must be double');
    }

    /**
     * @test
     */
    public function itCanRunTypeCastStringBeforeSettingAValue()
    {
        $this->mock->setCastString('50');
        $this->assertSame('50', $this->mock->getCastString());
        $this->assertInternalType('string', $this->mock->getCastString(), 'Value must be string');
    }

    /**
     * @test
     */
    public function itCanRunTypeCastArrayBeforeSettingAValue()
    {
        $this->mock->setCastArray('50');
        $this->assertSame(['50'], $this->mock->getCastArray());
        $this->assertInternalType('array', $this->mock->getCastArray(), 'Value must be array');
    }

    /**
     * @test
     */
    public function itCanRunTypeCastObjectBeforeSettingAValue()
    {
        $this->mock->setCastObject('50');
        $this->assertInternalType('object', $this->mock->getCastObject(), 'Value must be object');
    }
}
