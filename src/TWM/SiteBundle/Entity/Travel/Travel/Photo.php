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

use Doctrine\ORM\Mapping as ORM;
use TWM\SiteBundle\Entity\File\Photo as BasePhoto;
use TWM\SiteBundle\Entity\Travel\Travel\Travel;

/**
 * Represents a Photo of a Travel
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="TravelPhoto")
 */
class Photo extends BasePhoto
{

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Travel", inversedBy="photos")
     */
    protected $travel;

    /**
     * Set travel
     *
     * @param \TWM\SiteBundle\Entity\Travel\Travel\Travel $travel
     * @return Photo
     */
    public function setTravel(Travel $travel = null)
    {
        $this->travel = $travel;

        return $this;
    }

    /**
     * Get travel
     *
     * @return \TWM\SiteBundle\Entity\Travel\Travel\Travel
     */
    public function getTravel()
    {
        return $this->travel;
    }

}