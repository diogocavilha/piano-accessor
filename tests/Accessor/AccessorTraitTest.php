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
}
