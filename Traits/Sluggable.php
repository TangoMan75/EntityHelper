<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

/**
 * Trait Sluggable
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 */
trait Sluggable
{

    use Slugify;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $slug;

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Slug is generated from given string
     *
     * @param string $string
     *
     * @return $this
     */
    public function setSlug($string)
    {
        $this->slug = $this->slugify($string);

        return $this;
    }

    /**
     * Unique slug is generated from given string
     *
     * @param string $string
     *
     * @return $this
     */
    public function setUniqueSlug($string)
    {
        $this->slug = $this->slugify($string.'-'.uniqid());

        return $this;
    }
}
