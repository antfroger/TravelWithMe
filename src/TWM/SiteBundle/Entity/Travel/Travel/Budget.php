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

/**
 * Represents a Budget
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="TravelBudget")
 */
class Budget extends TravelDependency
{
    /**
     * @ORM\OneToMany(
     *  targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Travel",
     *  mappedBy="budget",
     *  cascade={"persist"}
     * )
     */
    protected $travels;
}
