<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Entity\Travel\Step;

use TWM\CommonBundle\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents a Restaurant
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\Entity
 */
class Restaurant extends Entity
{

    const DEFAULT_NAME = '';

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

    public function __construct($name = self::DEFAULT_NAME)
    {
        $this->name           = $name;
        $this->classification = null;
        $this->priceRange     = null;
        $this->description    = '';
        $this->address        = '';
        $this->city           = null;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Restaurant
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
     * @return Restaurant
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
     * @return Restaurant
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
     * @return Restaurant
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
