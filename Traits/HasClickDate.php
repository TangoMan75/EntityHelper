<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

/**
 * Trait HasClickDate
 * Adds "clickDate" timestamp to entity.
 * Entity constructor must initialize "DateTimeImmutable" object
 *     $this->clickDate = new \DateTimeImmutable();
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 */
trait HasClickDate
{

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $clickDate;

    /**
     * @return \DateTime
     */
    public function getClickDate()
    {
        return $this->clickDate;
    }

    /**
     * @param \DateTime $clickDate
     *
     * @return $this
     */
    public function setClickDate(\DateTimeImmutable $clickDate)
    {
        $this->clickDate = $clickDate;

        return $this;
    }
}
