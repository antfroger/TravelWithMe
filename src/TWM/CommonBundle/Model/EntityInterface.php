<?php

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
     * Sets the user id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId($id);

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
    public function getModificatedAt();

    /**
     * Sets the user's last modification date
     *
     * @param DateTime $date
     *
     * @return self
     */
    public function setModificatedAt(DateTime $date);

}