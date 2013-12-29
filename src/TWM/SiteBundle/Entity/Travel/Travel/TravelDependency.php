<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Entity\Travel\Travel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use TWM\CommonBundle\Entity\Entity;

/**
 * Base class for making a simple link between a Travel and its dependency
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\MappedSuperclass
 */
abstract class TravelDependency extends Entity
{

    const DEFAULT_NAME = null;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Travel", mappedBy="author", cascade={"persist"})
     */
    protected $travels;

    public function __construct($name = self::DEFAULT_NAME)
    {
        $this->name    = $name;
        $this->travels = new ArrayCollection();
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return TravelDependency
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
     * Set travels
     *
     * @param  \Doctrine\Common\Collections\ArrayCollection $travels
     * @return TravelDependency
     */
    public function setTravels(ArrayCollection $travels)
    {
        $this->clearTravels();

        foreach ($travels as $travel) {
            $this->addTravel($travel);
        }

        return $this;
    }

    /**
     * Get travels
     *
     * @return array
     */
    public function getTravels()
    {
        return $this->travels ?: $this->travels = new ArrayCollection();
    }

    /**
     * Add a travel
     *
     * @param  \TWM\SiteBundle\Entity\Travel\Travel\Travel $travel
     * @return TravelDependency
     */
    public function addTravel(Travel $travel)
    {
        if (!$this->getTravels()->contains($travel)) {
            $this->getTravels()->add($travel);
        }

        return $this;
    }

    /**
     * Remove a travel
     *
     * @param  \TWM\SiteBundle\Entity\Travel\Travel\Travel $travel
     * @return TravelDependency
     */
    public function removeTravel(Travel $travel)
    {
        if ($this->getTravels()->contains($travel)) {
            $this->getTravels()->removeElement($travel);
        }

        return $this;
    }

    /**
     * Remove all the travels
     *
     * @return TravelDependency
     */
    public function clearTravels()
    {
        $this->getTravels()->clear();

        return $this;
    }
}
