<?php

namespace TangoMan\EntityHelper\Traits;

use Doctrine\Common\Collections\Collection;
use TangoMan\EntityHelper\Utils\Inflect;

/**
 * Trait HasRelationships
 * ======================
 * This trait provide magic methods to handle both OWNING and INVERSE side of bidirectional relationships.
 *  - Both entities must use `HasRelationships` trait.
 *  - Both entities must define properties with appropriate annotations.
 *  - `cascade={"persist"}` annotation is MANDATORY (will allow bidirectional linking between entities).
 *  - In some cases, properties will have a strange singular.
 * OneToOne relationships
 * ----------------------
 * - `cascade={"remove"}` will avoid orphan `Item` on `Owner` deletion (optional).
 * ```php
 * use Doctrine\ORM\Mapping as ORM;
 * // ...
 * /**
 *  * {@}var Item
 *  * {@}ORM\OneToOne(targetEntity="AppBundle\Entity\Item", inversedBy="owner", cascade={"persist", "remove"})
 *  {@*}
 *  private $item;
 * ```
 * ManyToMany relationships
 * ------------------------
 * ### Entity properties
 * - Property must own `{@}var ArrayCollection`
 * - Property name MUST use plural form (as it represents several entities)
 * - `{@}ORM\OrderBy({"id"="DESC"})` will allow to define custom orderBy when fetching `items` (optional).
 * `src\AppBundle\Entity\Item.php`
 * ```php
 * namespace AppBundle\Entity;
 * use Doctrine\Common\Collections\ArrayCollection;
 * use Doctrine\ORM\Mapping as ORM;
 * // ...
 * /**
 *  * {@}var ArrayCollection
 *  * {@}ORM\ManyToMany(targetEntity="AppBundle\Entity\Item", inversedBy="owners", cascade={"persist"})
 *  * {@}ORM\OrderBy({"id"="DESC"})
 *  {@*}
 * private $items = [];
 * ```
 * ### Entity constructor
 * Constructor MUST initialize properties with `ArrayCollection`
 * `src\AppBundle\Entity\Item.php`
 * ```php
 * /**
 *  * Owner constructor.
 *  {@*}
 * public function __construct()
 * {
 *     $this->Items = new ArrayCollection();
 * }
 * ```
 * ### FormTypes
 * Requires formType to own `'by_reference' => false,` attribute to force use of `add` and `remove` methods.
 * `src\AppBundle\Form\ItemType.php`
 * ```php
 * /**
 *  * {@}param FormBuilderInterface $builder
 *  * {@}param array                $options
 *  {@*}
 * public function buildForm(FormBuilderInterface $builder, array $options)
 * {
 *     $builder
 *         ->add(
 *             'owner',
 *             EntityType::class,
 *             [
 *                 'label'         => 'Owner',
 *                 'placeholder'   => 'Select owner',
 *                 'class'         => 'AppBundle:Owner',
 *                 'by_reference'  => false,
 *                 'multiple'      => true,
 *                 'expanded'      => false,
 *                 'required'      => false,
 *                 'query_builder' => function (EntityRepository $em) {
 *                     return $em->createQueryBuilder('o')
 *                         ->orderBy('o.name');
 *                 },
 *             ]
 *         );
 * }
 * ```
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 */
trait HasRelationships
{
    /**
     * @var array
     */
    private static $genericMethods = [
        'set',
        'get',
        'link',
        'unLink',
    ];

    /**
     * @var array
     */
    private static $arrayMethods = [
        'add',
        'remove',
        'has',
        'link',
        'unLink',
    ];

    /**
     * This method allows to avoid twig error.
     * Warning: This will disable `by_reference` access to any object property.
     *
     * @param $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return false;
    }

    /**
     * @param $method
     * @param $arguments
     *
     * @return mixed|null
     */
    public function __call($method, $arguments)
    {
        $validMethods = implode("|", array_merge(self::$genericMethods, self::$arrayMethods));

        if (!preg_match('/^('.$validMethods.')(\w+)$/', $method, $matches)) {
            $action = '';
            $property = $method;
        }
        else {
            $property = lcfirst($matches[2]);
            $action = $matches[1];
        }

        if (!property_exists($this, $property) && !property_exists($this, $property = Inflect::pluralize($property))) {
            throw new \BadMethodCallException(
                'Method: '.$method.', or property: '.$property.' doesn\'t exist in class: '.get_class(
                    $this
                )
            );
        }


        if (is_array($this->$property) || $this->$property instanceof Collection) {

            switch ($action) {
                case 'set':
                    return $this->setMany($property, $arguments[0]);
                    break;
                case 'get':
                    return $this->get($property);
                    break;
                case 'has':
                    return $this->has($property, $arguments[0]);
                    break;
                case 'add':
                    return $this->add($property, $arguments[0]);
                    break;
                case 'remove':
                    return $this->remove($property, $arguments[0]);
                    break;
                case 'link':
                    $this->linkMany($property, $arguments[0]);
                    return null;
                    break;
                case 'unLink':
                    $this->unLinkMany($property, $arguments[0]);
                    return null;
                    break;
                case '': // Twig direct access
                    return $this->get($property);
                    break;
            }
        } else {
            switch ($action) {
                case 'set':
                    return $this->set($property, $arguments[0]);
                    break;
                case 'get':
                    return $this->get($property);
                    break;
                case 'link':
                    $this->linkOne($property, $arguments[0]);
                    return null;
                    break;
                case 'unLink':
                    $this->unLinkOne($property);
                    return null;
                    break;
                case '': // Twig direct access
                    return $this->get($property);
                    break;
            }
        }

        throw new \BadMethodCallException('Method '.$method.' doesn\'t exist in class: '.get_class($this));
    }

    /**
     * @param $property
     * @param $item
     *
     * @return $this
     */
    private function set($property, $item)
    {
        $class = substr(strrchr(get_class($this), '\\'), 1);

        if ($item) {
            $this->__call('link'.ucfirst($property), [$item]);
            $item->{'link'.$class}($this);
        } else {
            $this->__call('unLink'.ucfirst($property), [$item]);
            $item->{'unLink'.$class}($this);
        }

        return $this;
    }

    /**
     * @param $property
     * @param $items
     *
     * @return $this
     */
    private function setMany($property, $items)
    {
        foreach (array_diff($this->$property, $items) as $item) {
            $this->remove($property, $item);
        }

        foreach ($items as $item) {
            $this->add($property, $item);
        }

        return $this;
    }

    /**
     * @param $property
     * @param $item
     *
     * @return $this
     */
    private function add($property, $item)
    {
        $this->__call('link'.ucfirst($property), [$item]);

        $class = substr(strrchr(get_class($this), '\\'), 1);

        $item->{'link'.$class}($this);

        return $this;
    }

    /**
     * @param $property
     * @param $item
     *
     * @return $this
     */
    private function remove($property, $item)
    {
        $this->__call('unLink'.ucfirst($property), [$item]);
        $item->{'unLink'.ucfirst($property)}($this);

        return $this;
    }

    /**
     * @param $property
     *
     * @return null|mixed
     */
    private function get($property)
    {
        return $this->$property;
    }

    /**
     * @param $property
     *
     * @return bool|null
     */
    private function is($property)
    {
        return (bool)$this->$property;
    }

    /**
     * @param $property
     * @param $item
     *
     * @return bool|null
     */
    private function has($property, $item)
    {
        if ($this->$property->contains($item)) {
            return true;
        }

        return false;
    }

    /**
     * @param $property
     * @param $item
     */
    private function linkOne($property, $item)
    {
        if (property_exists($this, $property)) {
            $this->$property = $item;
        }
    }

    /**
     * @param $property
     */
    private function unLinkOne($property)
    {
        if (property_exists($this, $property)) {
            $this->$property = null;
        }
    }

    /**
     * @param $property
     * @param $item
     */
    private function linkMany($property, $item)
    {
        if (!$this->$property->contains($item)) {
            $this->$property[] = $item;
        }
    }

    /**
     * @param $property
     * @param $item
     */
    private function unLinkMany($property, $item)
    {
        $this->$property->removeElement($item);
    }
}
