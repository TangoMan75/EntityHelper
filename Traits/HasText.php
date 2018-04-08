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
    .'\HasText class is deprecated and will be removed.',
    E_USER_DEPRECATED
);

/**
 * Trait HasText
 *
 * @author      Matthias Morin <matthias.morin@gmail.com>
 * @package     TangoMan\EntityHelper\Traits
 * @depreceated TangoMan\EntityHelper\Traits\HasText class is deprecated and
 *              will be removed.
 */
trait HasText
{

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    protected $text;

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}
