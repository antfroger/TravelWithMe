<?php

namespace TWM\SiteBundle\Entity\Travel\Step;

use TWM\CommonBundle\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Step extends Entity
{

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Travel", inversedBy="steps")
     */
    protected $travel;

    public function __construct()
    {
        $this->travel = null;
    }

}