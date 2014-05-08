<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\UserBundle\Entity;

use DateTime;
use FOS\UserBundle\Model\User as BaseUser;
use TWM\CommonBundle\Model\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Base class for User implementations.
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks()
 */
abstract class User extends BaseUser implements EntityInterface
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
    protected $modifiedAt;

    /**
     * Set id
     *
     * @param  integer $id
     * @return Entity
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @param  DateTime $createdAt
     * @return Entity
     */
    public function setCreatedAt(DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt ? : new DateTime();

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * Set modifiedAt
     *
     * @param  DateTime $modifiedAt
     * @return $this
     */
    public function setModifiedAt(DateTime $modifiedAt = null)
    {
        $this->modifiedAt = $modifiedAt ? : new DateTime();

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setCreatedAt(new DateTime('now'));
        $this->setModifiedAt(new DateTime('now'));
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setModifiedAt(new DateTime('now'));
    }

}
