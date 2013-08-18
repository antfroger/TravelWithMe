<?php

namespace TWM\SiteBundle\Entity\Travel\Travel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use TWM\CommonBundle\Entity\Entity;

/**
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
        parent::__construct();

        $this->name    = $name;
        $this->travels = new ArrayCollection();
    }

    public function getTravels()
    {
        return $this->travels ? : $this->travels = new ArrayCollection();
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