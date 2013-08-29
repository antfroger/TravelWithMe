<?php

namespace TWM\SiteBundle\Entity\Travel\Step;

use TWM\CommonBundle\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Hotel extends Entity
{

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @todo
     */
    protected $classification;

    /**
     * @todo
     */
    protected $priceRange;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column
     */
    protected $address;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Location\City")
     */
    protected $city;

    /**
     * Set name
     *
     * @param string $name
     * @return Hotel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Hotel
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Hotel
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param \TWM\SiteBundle\Entity\Location\City $city
     * @return Hotel
     */
    public function setCity(\TWM\SiteBundle\Entity\Location\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \TWM\SiteBundle\Entity\Location\City
     */
    public function getCity()
    {
        return $this->city;
    }

}