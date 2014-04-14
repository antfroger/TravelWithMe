<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\CommonBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use TWM\CommonBundle\Model\EntityInterface;

/**
 * Base class for Entities
 * Provides some usefull properties for the entities
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks()
 */
abstract class Entity implements EntityInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $modificatedAt;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get createdAt
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param DateTime $date
     * @return $this
     */
    public function setCreatedAt(DateTime $date = null)
    {
        $this->createdAt = $date ? : new DateTime();

        return $this;
    }

    /**
     * Get modificatedAt
     *
     * @return DateTime
     */
    public function getModificatedAt()
    {
        return $this->modificatedAt;
    }

    /**
     * @param DateTime $date
     * @return $this
     */
    public function setModificatedAt(DateTime $date = null)
    {
        $this->modificatedAt = $date ? : new DateTime();

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setCreatedAt(new DateTime('now'));
        $this->setModificatedAt(new DateTime('now'));
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setModificatedAt(new DateTime('now'));
    }

}
