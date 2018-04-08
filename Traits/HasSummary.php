<?php
/**
 * Copyright (c) 2018 Matthias Morin <matthias.morin@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TangoMan\EntityHelper\Traits;

@trigger_error(
    'The '.__NAMESPACE__
    .'\HasSummary class is deprecated and will be removed.',
    E_USER_DEPRECATED
);

/**
 * Trait HasSummary
 *
 * @author  Matthias Morin <matthias.morin@gmail.com>
 * @package TangoMan\EntityHelper\Traits
 * @depreceated TangoMan\EntityHelper\Traits\HasSummary class is deprecated and will be removed.
 */
trait HasSummary
{

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    protected $summary;

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     *
     * @return $this
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }
}
