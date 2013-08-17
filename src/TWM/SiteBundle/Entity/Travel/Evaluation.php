<?php

namespace TWM\SiteBundle\Entity\Travel;

use TWM\CommonBundle\Entity\Entity;
use TWM\SiteBundle\Entity\Community\EvaluationInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="TravelEvaluation")
 */
class Evaluation extends Entity implements EvaluationInterface
{

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Travel", inversedBy="evaluations")
     */
    protected $travel;

    /**
     * @ORM\Column(type="integer")
     */
    protected $grade;

    /**
     * @ORM\Column(type="text")
     */
    protected $comment;

    /**
     * Set grade
     *
     * @param integer $grade
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
     * @param \TWM\SiteBundle\Entity\Travel\Travel $travel
     * @return Evaluation
     */
    public function setTravel(\TWM\SiteBundle\Entity\Travel\Travel $travel = null)
    {
        $this->travel = $travel;

        return $this;
    }

    /**
     * Get travel
     *
     * @return \TWM\SiteBundle\Entity\Travel\Travel
     */
    public function getTravel()
    {
        return $this->travel;
    }

    /**
     * Set comment
     *
     * @param string $comment
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