<?php

namespace TWM\CommonBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use TWM\CommonBundle\Model\EntityInterface;

/**
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
     * Set id
     *
     * @param integer $id
     * @return Entity
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     * @return Entity
     *
     * @ORM\PrePersist
     */
    public function setCreatedAt(DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt ?: new DateTime();

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
     * Set modificatedAt
     *
     * @param DateTime $modificatedAt
     * @return Entity
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setModificatedAt(DateTime $modificatedAt = null)
    {
        $this->modificatedAt = $modificatedAt ?: new DateTime();

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

}