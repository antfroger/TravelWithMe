<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Entity\Travel\Step;

use Doctrine\ORM\Mapping as ORM;
use TWM\SiteBundle\Entity\File\Photo as BasePhoto;
use TWM\SiteBundle\Entity\Travel\Step\Step;

/**
 * @ORM\Entity
 * @ORM\Table(name="StepPhoto")
 */
class Photo extends BasePhoto
{

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Step\Step", inversedBy="photos")
     */
    protected $step;

    /**
     * Set step
     *
     * @param \TWM\SiteBundle\Entity\Travel\Step\Step $step
     * @return Photo
     */
    public function setStep(Step $step = null)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return \TWM\SiteBundle\Entity\Travel\Step\Step
     */
    public function getStep()
    {
        return $this->step;
    }

}