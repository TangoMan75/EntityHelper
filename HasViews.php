<?php

namespace TangoMan\EntityHelper;

/**
 * Trait HasViews
 *
 * @author  Matthias Morin <tangoman@free.fr>
 * @package TangoMan\EntityHelper
 */
trait HasViews
{
    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $views;

    /**
     * @param integer $views
     *
     * @return $this
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * @return int
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @return $this
     */
    public function addView()
    {
        $this->views = ++$this->views;

        return $this;
    }
}