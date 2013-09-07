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

use TWM\CommonBundle\Entity\Entity;
use TWM\SiteBundle\Entity\Community\EvaluationInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represents an Evaluation
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="TravelEvaluation")
 */
class Evaluation extends Entity implements EvaluationInterface
{

    const DEFAULT_GRADE   = 0;
    const DEFAULT_COMMENT = '';

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Travel", inversedBy="evaluations")
     */
    protected $travel;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    protected $grade;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $comment;

    public function __construct($grade = self::DEFAULT_GRADE, $comment = self::DEFAULT_COMMENT)
    {
        $this->travel  = null;
        $this->grade   = $grade;
        $this->comment = $comment;
    }

    /**
     * Set grade
     *
     * @param  integer    $grade
     * @return Evaluation
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return integer
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set travel
     *
     * @param  \TWM\SiteBundle\Entity\Travel\Travel\Travel $travel
     * @return Evaluation
     */
    public function setTravel(\TWM\SiteBundle\Entity\Travel\Travel\Travel $travel = null)
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

    /**
     * Set comment
     *
     * @param  string     $comment
     * @return Evaluation
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

}
