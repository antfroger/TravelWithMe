<?php

namespace Antfroger\TravelWithMeBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
//@ORM\Table(name="`User`")
class User
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
    protected $creationTime;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $lastModificationTime;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $username;

    /**
     * @ORM\Column()
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $password;

    /**
     * @ORM\Column
     */
    protected $salt;

    public function __construct($userName = '', $email = '', $password = '', $id = 0, DateTime $creationTime = null, DateTime $lastModificationTime = null)
    {
        $this->id                   = $id;
        $this->creationTime         = $creationTime ? : new DateTime();
        $this->lastModificationTime = $lastModificationTime ? : new DateTime();
        $this->username             = $userName;
        $this->email                = $email;
        $this->password             = $password;
        $this->salt                 = '';
    }

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
     * Set creationTime
     *
     * @param DateTime $creationTime
     * @return User
     */
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    /**
     * Get creationTime
     *
     * @return DateTime
     */
    public function getCreationTime()
    {
        return $this->creationTime;
    }

    /**
     * Set lastModificationTime
     *
     * @param DateTime $lastModificationTime
     * @return User
     */
    public function setLastModificationTime($lastModificationTime)
    {
        $this->lastModificationTime = $lastModificationTime;

        return $this;
    }

    /**
     * Get lastModificationTime
     *
     * @return DateTime
     */
    public function getLastModificationTime()
    {
        return $this->lastModificationTime;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

}