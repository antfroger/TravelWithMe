<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\CommonBundle\Model;

use DateTime;

interface EntityInterface
{

    /**
     * Gets the user id
     *
     * @return int
     */
    public function getId();

    /**
     * Gets the user's creation date
     *
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * Sets the user's creation date
     *
     * @param DateTime $date
     *
     * @return self
     */
    public function setCreatedAt(DateTime $date);

    /**
     * Gets the user's last modification date
     *
     * @return DateTime
     */
    public function getModifiedAt();

    /**
     * Sets the user's last modification date
     *
     * @param DateTime $date
     *
     * @return self
     */
    public function setModifiedAt(DateTime $date);

}
