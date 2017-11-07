<?php

namespace TangoMan\EntityHelper\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Trait Relationship
 * This trait provide magic methods to handle both OWNING and INVERSE side of bidirectional relationships.
 * 1. Both entities MUST define properties with appropriate annotation.
 *     - When defining ManyToMany relationships property must own `@var ArrayCollection`
 *     - `cascade={"persist"}` will allow bidirectional linking between entities.
 *     - `cascade={"remove"}` will avoid orphan `Item` on `Owner` deletion (optional).
 *     - `@ORM\OrderBy({"id"="DESC"})` will allow to define custom orderBy when fetching `items` (optional).
 * 2. Entity constructor must initialize ArrayCollection object
 *     $this->items = new ArrayCollection();
 * 3. Requires formType to own `'by_reference => false,` attribute to force use of `add` and `remove` methods.
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Relationships
 */
trait HasRelationships
{
//    /**
//     * @var ArrayCollection
//     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Item", inversedBy="owners", cascade={"persist"})
//     * @ORM\OrderBy({"id"="DESC"})
//     */
//    private $items = [];

//    /*
//     * @var Item
//     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Item", inversedBy="owner", cascade={"persist", "remove"})
//     */
//     private $item;

    /**
     * @param $method
     * @param $arguments
     *
     * @return null
     */
    public function __call($method, $arguments)
    {
        // Check for valid method
        if (preg_match('/^(set|get|has|add|remove|link|unLink)(\w+)$/', $method, $matches)) {
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
                }
            } else {
                switch ($method) {
                    case 'set':
                        return $this->set($property, $arguments[0]);
                        break;
                    case 'get':
                        return $this->get($property);
                        break;
                    case 'link':
                        $this->link($property, $arguments[0]);
                        break;
                    case 'unLink':
                        $this->unLink($property, $arguments[0]);
                        break;
                }
            }
        }

        return null;
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
