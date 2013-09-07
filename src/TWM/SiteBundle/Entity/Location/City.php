<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Entity\Location;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use TWM\CommonBundle\Entity\Entity;

/**
 * Represents a City
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\Entity
 */
class City extends Entity
{

    const DEFAULT_NAME = '';

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Location\Country", inversedBy="cities")
     * @Assert\NotBlank
     */
    protected $country;

    /**
     * @ORM\Column(type="float")
     */
    protected $latitude;

    /**
     * @ORM\Column(type="float")
     */
    protected $longitude;

    public function __construct($name = self::DEFAULT_NAME)
    {
        $this->name      = $name;
        $this->country   = null;
        $this->latitude  = 0;
        $this->longitude = 0;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return City
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
     * Set country
     *
     * @param \TWM\SiteBundle\Entity\Location\Country $country
     * @return City
     */
    public function setCountry(\TWM\SiteBundle\Entity\Location\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \TWM\SiteBundle\Entity\Location\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return City
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return City
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

}
