<?php

namespace TWM\UserBundle\Entity;

use DateTime;
use FOS\UserBundle\Model\User as BaseUser;
use TWM\CommonBundle\Model\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="`User`")
 */
class User extends BaseUser implements EntityInterface
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

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $date)
    {
        $this->createdAt = $date;

        return $this;
    }

    public function getModificatedAt()
    {
        return $this->modificatedAt;
    }

    public function setModificatedAt(DateTime $date)
    {
        $this->modificatedAt = $date;

        return $this;
    }

}