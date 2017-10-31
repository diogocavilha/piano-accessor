<?php

namespace Tests\Acessor;

use Tests\Mock;
use Piano\AccessorTrait;

class AccessorTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testItCanSetIntAndGetInt()
    {
        $user = new class
        {
            use AccessorTrait;

            /**
             * @set int
             * @get int
             */
            private $age;
        };

        $expected = 42;
        $user->setAge($expected);

        $this->assertEquals($expected, $user->getAge());
        $this->assertInternalType('int', $user->getAge());
    }

    public function testItCanSetBoolAndGetBool()
    {
        $user = new class
        {
            use AccessorTrait;

            /**
             * @set bool
             * @get bool
             */
            private $active;
        };

        $expected = false;
        $user->setActive($expected);

        $actual = $user->getActive();

        $this->assertEquals($expected, $actual);
        $this->assertInternalType('bool', $actual);
        $this->assertFalse($actual);

        $expected = true;
        $user->setActive($expected);

        $actual = $user->getActive();

        $this->assertEquals($expected, $actual);
        $this->assertInternalType('bool', $actual);
        $this->assertTrue($actual);
    }

    public function testItCanSetFloatAndGetFloat()
    {
        $user = new class
        {
            use AccessorTrait;

            /**
             * @set float
             * @get float
             */
            private $weight;
        };

        $expected = 72.56;
        $user->setWeight($expected);

        $this->assertEquals($expected, $user->getWeight());
        $this->assertInternalType('float', $user->getWeight());
    }

    public function testItCanSetStringAndGetString()
    {
        $user = new class
        {
            use AccessorTrait;

            /**
             * @set string
             * @get string
             */
            private $name;
        };

        $expected = 'Diogo';
        $user->setName($expected);

        $actual = $user->getName();

        $this->assertEquals($expected, $actual);
        $this->assertInternalType('string', $actual);
    }

    public function testItCanSetArrayAndGetArray()
    {
        $user = new class
        {
            use AccessorTrait;

            /**
             * @set array
             * @get array
             */
            private $phones;
        };

        $expected = [5555555, 9999999];
        $user->setPhones($expected);

        $actual = $user->getPhones();

        $this->assertEquals($expected, $actual);
        $this->assertInternalType('array', $actual);
        $this->assertArraySubset($expected, $actual);
    }

    /**
     * Implement return type
     */
    public function testItCanSetDateTimeAndGetDateTime()
    {
        $obj = new class
        {
            use AccessorTrait;

            /**
             * @set DateTime
             * @get
             */
            private $date;
        };

        $expected = new \DateTime();
        $obj->setDate($expected);

        $actual = $obj->getDate();

        $this->assertEquals($expected, $actual);
        $this->assertInstanceOf('\DateTime', $actual);
    }
}
