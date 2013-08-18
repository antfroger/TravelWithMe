<?php

namespace TWM\SiteBundle\Entity\Location;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use TWM\CommonBundle\Entity\Entity;

/**
 * @ORM\Entity
 */
class City extends Entity
{

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Location\Country", inversedBy="cities")
     */
    protected $country;

}