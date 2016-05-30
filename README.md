[![Build Status](https://travis-ci.org/diogocavilha/piano-accessor.svg?branch=master)](https://travis-ci.org/diogocavilha/piano-accessor)
[![Latest Stable Version](https://img.shields.io/packagist/v/piano/accessor.svg?style=flat-square)](https://packagist.org/packages/piano/accessor)

# Piano Accessor

This package allows us to create getters and setters just by using a few annotations.

# Installing

```sh
composer require piano/accessor
```

# Usage example

See the example:

This `User` class:

```php
<?php

namespace App;

class User
{
    private $name;
    private $age;
    private $createdAt;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAge($age)
    {
        $this->age = (int) $age;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return (int) $this->age;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
```

Is the same as this `User` class:

```php
<?php

namespace App;

class User
{
    use \Piano\AccessorTrait;

    /**
     * @set
     * @get
     */
    private $name;

    /**
     * @set int
     * @get int
     */
    private $age;

    /**
     * @set \DateTime
     * @get
     */
    private $createdAt;
}
```

As you can see it's possible to specify the type hint or type cast when defining the `@set` and it's also possible to specify the type cast when defining the `@get`.
That's optional though.
