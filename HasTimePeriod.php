<?php

namespace TangoMan\EntityHelper;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

Trait HasTimePeriod
{
    /**
     * @var \DateTime
     * @Assert\Date(message="La date doit être dans un format valide.")
     * @ORM\Column(type="datetime")
     */
    protected $start;

    /**
     * @var \DateTime
     * @Assert\Date(message="La date doit être dans un format valide.")
     * @ORM\Column(type="datetime")
     */
    protected $end;

    /**
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param \DateTime $start
     *
     * @return $this
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param \DateTime $end
     *
     * @return $this
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }
}
