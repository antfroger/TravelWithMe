<?php

namespace TWM\SiteBundle\Entity\Community;

interface EvaluationInterface
{

    /**
     * Get the grade
     *
     * @return integer
     */
    public function getGrade();

    /**
     * Set the grade
     *
     * @param integer $grade
     * @return EvaluationInterface
     */
    public function setGrade($grade);

    /**
     * Get the comment
     *
     * @return string
     */
    public function getComment();

    /**
     * Set the comment
     *
     * @param string $comment
     * @return EvaluationInterface
     */
    public function setComment($comment);
    
}