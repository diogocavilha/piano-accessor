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
     */
    public function itShouldNotCreateGetterAndSetterWhenThereIsNoAnnotations()
    {
        $this->mock->setNonGetterAndSetter('test');
        $this->assertNull($this->mock->getNonGetterAndSetter());
    }

    /**
     * @test
     */
    public function itCanCreateSimpleGetterAndSetter()
    {
        $this->mock->setGetterAndSetterSimple('test');
        $this->assertEquals('test', $this->mock->getGetterAndSetterSimple(), 'Expected value must be test');
    }
}
