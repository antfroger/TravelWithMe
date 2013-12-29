<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use TWM\SiteBundle\Entity\Travel\Travel\Travel;
use TWM\UserBundle\Entity\User as BaseUser;

/**
 * Represents a User
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="`User`")
 */
class User extends BaseUser
{

    /**
     * @ORM\OneToMany(targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Travel",
     * mappedBy="author", cascade={"persist"})
     */
    protected $travels;

    /**
     * @ORM\Column(length=20)
     */
    protected $ip;

    public function __construct()
    {
        parent::__construct();

        $this->travels = new ArrayCollection();
        $this->ip      = '';
    }

    /**
     * Set travels
     *
     * @param  \Doctrine\Common\Collections\ArrayCollection $travels
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
     */
    public function clearTravels()
    {
        $this->getTravels()->clear();

        return $this;
    }

    /**
     * Set ip
     *
     * @param  string $ip
     * @return User
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

}
