TangoMan Entity Helper
==========================

**TangoMan Entity Helper** provides a collection of traits for common properties to use in your project entities.

Features
========

 - Included asserts with custom messages (french) for property validation.
 - Fluent setters for all properties, allowing chaining.
 - Magic JsonSerialisable.

Installation
============

Step 1: Download the Helper
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this helper:

```bash
$ composer require tangoman/entity-helper
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable VichUploader
---------------------------

Since **TangoMan Entity Helper** requires [VichUploaderBundle](https://github.com/dustin10/VichUploaderBundle),
if you plan to use **UploadableDocument**, or **UploadableImage** traits,
enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    // ...

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Vich\UploaderBundle\VichUploaderBundle(),
        );

        // ...
    }
}
```

Step 3: Implement your entities
-------------------------------

Add "use" statements inside your entities for desired traits. See below for full list of availlable traits.

Step 4: Update your database schema
-----------------------------------

Open a command console, enter your project directory and execute the
following command to update your database schema:

```console
$ php bin/console schema:update
```

Usage
=====

Inside your entity class:
Some traits will require your entity class to use `Symfony\Component\Validator\Constraints` for validation.
**UploadableDocument** and **UploadableImage** traits will require your entity class to use 
`Vich\UploaderBundle\Mapping\Annotation as Vich` annotation.

`src\AppBundle\Entity\FooBar.php`
```php
<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

// ...

use TangoMan\EntityHelper\Traits\Categorized;
use TangoMan\EntityHelper\Traits\Embeddable;
use TangoMan\EntityHelper\Traits\Featurable;
use TangoMan\EntityHelper\Traits\HasAddress;
use TangoMan\EntityHelper\Traits\HasBirthDate;
use TangoMan\EntityHelper\Traits\HasClickDate;
use TangoMan\EntityHelper\Traits\HasEmail;
use TangoMan\EntityHelper\Traits\HasFirstAndLastName;
use TangoMan\EntityHelper\Traits\HasFontAwesomeIcon;
use TangoMan\EntityHelper\Traits\HasGender;
use TangoMan\EntityHelper\Traits\HasGlyphicon;
use TangoMan\EntityHelper\Traits\HasIcon;
use TangoMan\EntityHelper\Traits\HasLabel;
use TangoMan\EntityHelper\Traits\HasMobile;
use TangoMan\EntityHelper\Traits\HasName;
use TangoMan\EntityHelper\Traits\HasPhone;
use TangoMan\EntityHelper\Traits\HasRoles;
use TangoMan\EntityHelper\Traits\HasSummary;
use TangoMan\EntityHelper\Traits\HasText;
use TangoMan\EntityHelper\Traits\HasTimePeriod;
use TangoMan\EntityHelper\Traits\HasTitle;
use TangoMan\EntityHelper\Traits\HasType;
use TangoMan\EntityHelper\Traits\HasViews;
use TangoMan\EntityHelper\Traits\HasWebsite;
use TangoMan\EntityHelper\Traits\HasWork;
use TangoMan\EntityHelper\Traits\Illustrable;
use TangoMan\EntityHelper\Traits\JsonSerializable;
use TangoMan\EntityHelper\Traits\Privatable;
use TangoMan\EntityHelper\Traits\Publishable;
use TangoMan\EntityHelper\Traits\Sluggable;
use TangoMan\EntityHelper\Traits\Slugify;
use TangoMan\EntityHelper\Traits\Timestampable;
use TangoMan\EntityHelper\Traits\UploadableDocument;
use TangoMan\EntityHelper\Traits\UploadableImage;

/**
 * Class Foobar
 *
 * @package AppBundle\Entity
 */
class Foobar
{
    use Categorized;
    use Embeddable;
    use Featurable;
    use HasAddress;
    use HasBirthDate;
    use HasClickDate;
    use HasEmail;
    use HasFirstAndLastName;
    use HasFontAwesomeIcon;
    use HasGender;
    use HasGlyphicon;
    use HasIcon;
    use HasLabel;
    use HasMobile;
    use HasName;
    use HasPhone;
    use HasRoles;
    use HasSummary;
    use HasText;
    use HasTimePeriod;
    use HasTitle;
    use HasType;
    use HasViews;
    use HasWebsite;
    use HasWork;
    use Illustrable;
    use JsonSerializable;
    use Privatable;
    use Publishable;
    use Sluggable;
    use Slugify;
    use Timestampable;
    use UploadableDocument;
    use UploadableImage;

    // ...
}
```

Trait JsonSerializable
======================

Magic method to make your entities [jsonserializable](http://php.net/manual/en/class.jsonserializable.php).
Allows to use php `json_encode()` function on your object.
```php
$fooBar = new FooBar;
$json = json_encode($fooBar, JSON_PRETTY_PRINT);
echo $json;
```

In order to use php JsonSerializable interface on your object your class must implement `\JsonSerializable`
`src\AppBundle\Entity\FooBar.php`
```php
namespace AppBundle\Entity;

use TangoMan\EntityHelper\Traits\JsonSerializable;

class FooBar implements \JsonSerializable {
    use JsonSerializable;

    // ...
```

Note
====

If you find any bug please report here : [Issues](https://github.com/TangoMan75/EntityHelper/issues/new)

License
=======

Copyright (c) 2018 Matthias Morin

[![License][license-MIT]][license-url]
Distributed under the MIT license.

If you like **TangoMan Entity Helper** please star!
And follow me on GitHub: [TangoMan75](https://github.com/TangoMan75)
... And check my other cool projects.

[Matthias Morin | LinkedIn](https://www.linkedin.com/in/morinmatthias)

[license-MIT]: https://img.shields.io/badge/Licence-MIT-green.svg
[license-url]: LICENSE
