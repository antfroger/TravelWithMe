<?php

namespace TWM\SiteBundle\Entity\Location;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use TWM\CommonBundle\Entity\Entity;

/**
 * @ORM\Entity
 */
class Country extends Entity
{

    /**
     * @ORM\Column(length=5)
     * @Assert\NotBlank
     */
    protected $code;

    /**
     * @ORM\OneToMany(targetEntity="TWM\SiteBundle\Entity\Location\City", mappedBy="country", cascade={"persist", "remove"})
     */
    protected $cities;

}