<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Trait Categorized
 * This class is designed to provide a simple and straitforward way to
 * categorize entities.
 * 1. Requires entity to be marked with "HasLifecycleCallbacks" annotation.
 * 2. Requires entity to own "HasType" trait.
 * 3. Note: Entities can own one type only, but can have several categories.
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 */
trait Categorized
{

    /**
     * @var array|ArrayCollection
     * @ORM\Column(type="simple_array", nullable=true)
     */
    protected $categories = [];

    /**
     * These are the associated categories of each type
     *
     * @var array
     */
    protected $assoc
        = [
            'csv'         => 'document',
            'doc'         => 'document',
            'ods'         => 'document',
            'odt'         => 'document',
            'pdf'         => 'document',
            'pptx'        => 'document',
            'txt'         => 'document',
            'xls'         => 'document',
            'article'     => 'post',
            'message'     => 'post',
            'comment'     => 'post',
            'gif'         => 'image',
            'jpeg'        => 'image',
            'jpg'         => 'image',
            'png'         => 'image',
            'dailymotion' => 'embed',
            'giphy'       => 'embed',
            'gist'        => 'embed',
            'tweet'       => 'embed',
            'vimeo'       => 'embed',
            'youtube'     => 'embed',
            'argus360'    => '360',
            'thetas'      => '360',
        ];

    /**
     * @param array $categories
     *
     * @return $this
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return bool
     */
    public function hasCategory($category)
    {
        if (in_array($category, (array)$this->categories)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $category
     *
     * @return $this
     */
    public function addCategory($category)
    {
        if ( ! in_array($category, (array)$this->categories)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    /**
     * @param string $category
     *
     * @return $this
     */
    public function removeCategory($category)
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @ORM\PreFlush()
     */
    public function setDefaultCategories()
    {
        if ($this->type) {
            foreach ($this->assoc as $type => $category) {
                if ($this->type == $type) {
                    $this->addCategory($category);
                }
            }
        }
    }
}