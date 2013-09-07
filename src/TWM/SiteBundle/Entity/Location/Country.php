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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use TWM\CommonBundle\Entity\Entity;

/**
 * Represents a Country
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\Entity
 */
class Country extends Entity
{

    const DEFAULT_CODE      = '';
    const DEFAULT_NAME      = '';
    const DEFAULT_CONTINENT = '';

    /**
     * @ORM\Column(length=2)
     */
    protected $code;

    /**
     * @ORM\Column
     */
    protected $name;

    /**
     * @ORM\Column(length=2)
     */
    protected $continent;

    /**
     * @ORM\OneToMany(targetEntity="TWM\SiteBundle\Entity\Location\City", mappedBy="country", cascade={"persist", "remove"})
     */
    protected $cities;

    /**
     * Constructor
     */
    public function __construct($code = self::DEFAULT_CODE, $name = self::DEFAULT_NAME,
                                $continent = self::DEFAULT_CONTINENT)
    {
        $this->code      = $code;
        $this->name      = $name;
        $this->continent = $continent;
        $this->cities    = new ArrayCollection();
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Country
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return string
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
     * Add cities
     *
     * @param \TWM\SiteBundle\Entity\Location\City $city
     * @return Country
     */
    public function addCity(\TWM\SiteBundle\Entity\Location\City $city)
    {
        if (!$this->getCities()->contains($city)) {
            $this->getCities()->add($city);
        }

        return $this;
    }

    /**
     * Remove cities
     *
     * @param \TWM\SiteBundle\Entity\Location\City $city
     */
    public function removeCity(\TWM\SiteBundle\Entity\Location\City $city)
    {
        if ($this->getCities()->contains($city)) {
            $this->getCities()->removeElement($city);
        }

        return $this;
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Set continent
     *
     * @param string $continent
     * @return Country
     */
    public function setContinent($continent)
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * Get continent
     *
     * @return string
     */
    public function getContinent()
    {
        return $this->continent;
    }

}
