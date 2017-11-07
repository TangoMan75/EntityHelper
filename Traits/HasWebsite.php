<?php

namespace TangoMan\EntityHelper\Traits;

/**
 * Trait HasWebsite
 *
 * @author  Matthias Morin <tangoman@free.fr>
 * @package TangoMan\EntityHelper
 */
Trait HasWebsite
{
    /**
     * @var String
     * @Assert\Url(message="L'url '{{ value }}' doit être dans un format valide.")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $website;

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     *
     * @return $this
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }
}
