<?php

namespace TangoMan\EntityHelper;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

Trait UserInfos
{
    /**
     * @var string
     * @Assert\Type(
     *     type="alpha",
     *     message="Votre prénom ne peut contenir que des caractères alphabétiques."
     * )
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstName;

    /**
     * @var string
     * @Assert\Type(
     *     type="alpha",
     *     message="Votre nom ne peut contenir que des caractères alphabétiques."
     * )
     * @ORM\Column(type="string", nullable=true)
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $companyName;

    /**
     * @var string
     * @Assert\Type(
     *     type="alpha",
     *     message="Le titre de votre poste ne peut contenir que des caractères alphabétiques."
     * )
     * @ORM\Column(type="string", nullable=true)
     */
    private $jobTitle;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\+?\[0-9]+/",
     *     message="Votre numéro de téléphone doit être dans un format valide."
     * )
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $phoneNumber;

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     *
     * @return $this
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param string $jobTitle
     *
     * @return $this
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

}
