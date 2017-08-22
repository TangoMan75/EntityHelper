<?php

namespace TangoMan\EntityHelper;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

Trait HasMobile
{
    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\+?\[0-9]+/",
     *     message="Votre numéro de portable doit être dans un format valide."
     * )
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    protected $mobile;

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     *
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }
}