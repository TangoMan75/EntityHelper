<?php

namespace TangoMan\EntityHelper;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

Trait HasEmail
{
    /**
     * @var string
     * @Assert\Email(
     *     message="L'email '{{ value }}' doit être dans un format valide.",
     * )
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return HasEmail
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}
