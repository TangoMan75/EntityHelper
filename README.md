TangoMan Entity Helper
==========================

**TangoMan Entity Helper** provides magic methods for relationships, JsonSerializable, Getters and Setters for common properties.

Features
========

 - Magic methods for OneToOne, OneToMany, ManyToOne, ManyToMany, relationships.
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
**UploadableDocument** and **UploadableImage** traits will require your entity class to use `Vich\UploaderBundle\Mapping\Annotation as Vich` annotation.

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
use TangoMan\EntityHelper\Traits\HasRelationships;
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
    use HasRelationships;
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

Trait HasRelationships
======================

This trait provide magic methods to handle both OWNING and INVERSE side of bidirectional relationships.

 - Both entities MUST use `HasRelationships` trait.
 - Both entities MUST define properties with appropriate annotations.
 - `cascade={"persist"}` annotation is MANDATORY (will allow bidirectional linking between entities).

OneToOne relationships
----------------------

- `cascade={"remove"}` will avoid orphan `Item` on `Owner` deletion (optional).

```php
use Doctrine\ORM\Mapping as ORM;

// ...

/**
 * @var Item
 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Item", inversedBy="owner", cascade={"persist", "remove"})
 */
 private $item;
```

ManyToMany relationships
------------------------

### Entity properties

- property must own `@var ArrayCollection`
- `@ORM\OrderBy({"id"="DESC"})` will allow to define custom orderBy when fetching `items` (optional).

`src\AppBundle\Entity\Item.php`
```php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

// ...

/**
 * @var ArrayCollection
 * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Item", inversedBy="owners", cascade={"persist"})
 * @ORM\OrderBy({"id"="DESC"})
 */
private $items = [];
```

### Entity constructor

Constructor must initialize mapped property with `ArrayCollection`

`src\AppBundle\Entity\Item.php`
```php
/**
 * Owner constructor.
 */
public function __construct()
{
    $this->Items = new ArrayCollection();
}
```

### FormTypes

Requires formType to own `'by_reference' => false,` attribute to force use of `add` and `remove` methods.

`src\AppBundle\Form\ItemType.php`
```php
/**
 * @param FormBuilderInterface $builder
 * @param array                $options
 */
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add(
            'owner',
            EntityType::class,
            [
                'label'         => 'Owner',
                'placeholder'   => 'Select owner',
                'class'         => 'AppBundle:Owner',
                'by_reference'  => false,
                'multiple'      => true,
                'expanded'      => false,
                'required'      => false,
                'query_builder' => function (EntityRepository $em) {
                    return $em->createQueryBuilder('o')
                        ->orderBy('o.name');
                },
            ]
        );
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

Copyrights (c) 2017 Matthias Morin

[![License][license-MIT]][license-url]
Distributed under the MIT license.

If you like **TangoMan Entity Helper** please star!
And follow me on GitHub: [TangoMan75](https://github.com/TangoMan75)
... And check my other cool projects.

[Matthias Morin | LinkedIn](https://www.linkedin.com/in/morinmatthias)

[license-GPL]: https://img.shields.io/badge/Licence-GPLv3.0-green.svg
[license-MIT]: https://img.shields.io/badge/Licence-MIT-green.svg
[license-url]: LICENSE
