<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

/**
 * Trait HasLabel
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 */
trait HasLabel
{

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $label;

    /**
     * @var array
     */
    public $validLabels
        = [
            'default',
            'primary',
            'secondary',
            'success',
            'danger',
            'warning',
            'info',
            'light',
            'dark',
        ];

    /**
     * @return string
     */
    public function getLabel()
    {
        if ( ! $this->label) {
            return 'default';
        }

        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        if (in_array(
            $label,
            $this->validLabels
        )) {
            $this->label = $label;
        }

        return $this;
    }
}
