<?php

namespace TWM\UserBundle\Entity;

use DateTime;
use FOS\UserBundle\Model\User as BaseUser;
use TWM\CommonBundle\Model\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
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
    protected $modificatedAt;

    public function __construct(DateTime $createdAt = null, DateTime $modificatedAt = null)
    {
        parent::__construct();

        $this->createdAt     = $createdAt ? : new DateTime();
        $this->modificatedAt = $modificatedAt ? : new DateTime();
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getModificatedAt()
    {
        return $this->modificatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt(DateTime $date = null)
    {
        $this->createdAt = $date ? : new DateTime();

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setModificatedAt(DateTime $date = null)
    {
        $this->modificatedAt = $date ? : new DateTime();

        return $this;
    }

}