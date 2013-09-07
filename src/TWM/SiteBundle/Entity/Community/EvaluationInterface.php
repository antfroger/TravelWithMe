<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Entity\Community;

/**
 * Interface for Evaluation implementations.
 *
 * @author Antoine Froger <antfroger@gmail.com>
 */
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