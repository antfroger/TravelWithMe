<?php

namespace TWM\SiteBundle\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use TWM\SiteBundle\Entity\Travel\Travel;
use TWM\UserBundle\Entity\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="`User`")
 */
class User extends BaseUser
{

    /**
     * @ORM\OneToMany(targetEntity="TWM\SiteBundle\Entity\Travel\Travel", mappedBy="author", cascade={"persist"})
     */
    protected $travels;

    public function __construct()
    {
        parent::__construct();

        $this->travels = new ArrayCollection();
    }

    public function getTravels()
    {
        return $this->travels ?: $this->travels = new ArrayCollection();
    }

    public function addTravel(Travel $travel)
    {
        if (!$this->getTravels()->contains($travel)) {
            $this->getTravels()->add($travel);
        }

        return $this;
    }

    public function removeTravel(Travel $travel)
    {
        if ($this->getTravels()->contains($travel)) {
            $this->getTravels()->removeElement($travel);
        }

        return $this;
    }

}