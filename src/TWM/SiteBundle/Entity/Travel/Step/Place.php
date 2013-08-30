<?php

namespace TWM\SiteBundle\Entity\Travel\Step;

use TWM\CommonBundle\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Place extends Entity
{

    const DEFAULT_NAME = '';

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     */
    protected $price;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @todo
     */
    protected $type;

    /**
     * @ORM\Column
     */
    protected $address;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Location\City")
     */
    protected $city;

    public function __construct($name = self::DEFAULT_NAME)
    {
        $this->name           = $name;
        $this->price          = '';
        $this->description    = '';
        $this->type           = null;
        $this->address        = '';
        $this->city           = null;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Place
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
     * Set price
     *
     * @param string $price
     * @return Place
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Place
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
     * @return Place
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
     * @return Place
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