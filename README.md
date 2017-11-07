TangoMan Entity Helper
==========================

**TangoMan Entity Helper** provides magic methods for OneToOne, OneToMany, ManyToOne, ManyToMany, relationships and Getters and Setters for common properties.

Features
--------

 - Included asserts with custom messages (french) for property validation.
 - All setters fluent, allowing chaining.

How to install
--------------

With composer

```console
$ composer require tangoman/entity-helper
```

How to use
----------

Inside your entity:
Add "use" statement just like when you're using a trait.

```php
<?php

namespace AppBundle\Entity;

use Tangoman\EntityHelper\Categorized;
use Tangoman\EntityHelper\Embeddable;
use Tangoman\EntityHelper\Featurable;
use Tangoman\EntityHelper\HasAddress;
use Tangoman\EntityHelper\HasBirthDate;
use Tangoman\EntityHelper\HasClickDate;
use Tangoman\EntityHelper\HasEmail;
use Tangoman\EntityHelper\HasFirstAndLastName;
use Tangoman\EntityHelper\HasFontAwesomeIcon;
use Tangoman\EntityHelper\HasGender;
use Tangoman\EntityHelper\HasGlyphicon;
use Tangoman\EntityHelper\HasIcon;
use Tangoman\EntityHelper\HasLabel;
use Tangoman\EntityHelper\HasMobile;
use Tangoman\EntityHelper\HasName;
use Tangoman\EntityHelper\HasPhone;
use Tangoman\EntityHelper\HasSummary;
use Tangoman\EntityHelper\HasText;
use Tangoman\EntityHelper\HasTimePeriod;
use Tangoman\EntityHelper\HasTitle;
use Tangoman\EntityHelper\HasType;
use Tangoman\EntityHelper\HasViews;
use Tangoman\EntityHelper\HasWork;
use Tangoman\EntityHelper\Illustrable;
use Tangoman\EntityHelper\Privatable;
use Tangoman\EntityHelper\Publishable;
use Tangoman\EntityHelper\Sluggable;
use Tangoman\EntityHelper\Slugify;
use Tangoman\EntityHelper\Timestampable;
use Tangoman\EntityHelper\UploadableDocument;
use Tangoman\EntityHelper\UploadableImage;

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
    use HasSummary;
    use HasText;
    use HasTimePeriod;
    use HasTitle;
    use HasType;
    use HasViews;
    use HasWork;
    use Illustrable;
    use Privatable;
    use Publishable;
    use Sluggable;
    use Slugify;
    use Timestampable;
    use UploadableDocument;
    use UploadableImage;
}
```

Don't forget to update database schema

```console
$ php bin/console schema:update
```

Note
====

If you find any bug please report here : [Issues](https://github.com/TangoMan75/EntityHelper/issues/new)

License
=======

Copyrights (c) 2017 Matthias Morin

[![License][license-GPL]][license-url]
Distributed under the GPLv3.0 license.

If you like **TangoMan Entity Helper** please star!
And follow me on GitHub: [TangoMan75](https://github.com/TangoMan75)
... And check my other cool projects.

[tangoman.free.fr](http://tangoman.free.fr)

[license-GPL]: https://img.shields.io/badge/Licence-GPLv3.0-green.svg
[license-MIT]: https://img.shields.io/badge/Licence-MIT-green.svg
[license-url]: LICENSE
