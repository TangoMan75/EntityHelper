<?php

namespace TangoMan\EntityHelper\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Trait HasRelationships
 * ======================
 * This trait provide magic methods to handle both OWNING and INVERSE side of bidirectional relationships.
 *  - Both entities MUST use `HasRelationships` trait.
 *  - Both entities MUST define properties with appropriate annotations.
 *  - `cascade={"persist"}` annotation is MANDATORY (will allow bidirectional linking between entities).
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
 * ### Entity
 * #### Properties
 * - property must own `{@}var ArrayCollection`
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
 * #### Constructor
 * Constructor must initialize mapped property with `ArrayCollection`
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
     * @param $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        if (property_exists($this, $name)) {
            return true;
        }

        return false;
    }

    /**
     * @param $methodFullName
     * @param $arguments
     *
     * @return mixed|null
     */
    public function __call($methodFullName, $arguments)
    {
        // Check for valid method
        preg_match('/^(set|get|has|add|remove|link|unLink)?(\w+)$/', $methodFullName, $matches);
        $method = $matches[1];
        $property = lcfirst($matches[2]);

        if (!property_exists($this, $property)) {
            throw new \BadMethodCallException('Method '.$method.' or property '.$property.' doesn\'t exist');
        }

        // Check for valid property
        if (is_array($this->$property) || $this->$property instanceof Collection) {
            switch ($method) {
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
                    break;
                case 'unLink':
                    $this->unLinkMany($property, $arguments[0]);
                    break;
                case '': // direct access like in twig
                    return $this->get($property);
                    break;
            }
        } else {
            switch ($method) {
                case 'set':
                    return $this->set($property, $arguments[0]);
                    break;
                case 'get':
                    return $this->get($property);
                    break;
                case 'is':
                    if (is_bool($this->$property)) {
                        return $this->is($property);
                    } else {
                        throw new \BadMethodCallException('Method '.$methodFullName.' doesn\'t exist');
                    }
                    break;
                case 'link':
                    $this->link($property, $arguments[0]);
                    break;
                case 'unLink':
                    $this->unLink($property, $arguments[0]);
                    break;
                case '': // direct access like in twig
                    return $this->get($property);
                    break;
            }
        }

        throw new \BadMethodCallException('Method '.$methodFullName.' doesn\'t exist');
    }

    /**
     * @param $property
     * @param $item
     *
     * @return $this
     */
    private function set($property, $item)
    {
        if ($item) {
            $this->link{ucfirst($property)}($item);
            $item->link{ucfirst($property)}($this);
        } else {
            $this->unLink{ucfirst($property)}($item);
            $item->unLink{ucfirst($property)}($this);
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
        $this->{'link'.ucfirst($property)}($item);
        $item->{'link'.ucfirst($property)}($this);

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
        $this->{'unLink'.ucfirst($property)}($item);
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
    private function link($property, $item)
    {
        if (isset($this->$property)) {
            $this->$property = $item;
        }
    }

    /**
     * @param $property
     * @param $item
     */
    private function unLink($property, $item)
    {
        if (isset($this->$property)) {
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
