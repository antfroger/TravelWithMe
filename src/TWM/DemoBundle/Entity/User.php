<?php

namespace TWM\DemoBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="TWM\DemoBundle\Entity\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="`DemoUser`")
 */
class User implements AdvancedUserInterface, Serializable
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
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=32)
     */
    protected $salt;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     */
    private $roles;

    public function __construct($userName = '', $email = '', $password = '', $id = 0, DateTime $creationTime = null, DateTime $lastModificationTime = null)
    {
        $this->id                   = $id;
        $this->creationTime         = $creationTime;
        $this->lastModificationTime = $lastModificationTime;
        $this->username             = $userName;
        $this->email                = $email;
        $this->password             = $password;
        $this->salt                 = '';
        $this->isActive             = true;
        $this->roles                = new ArrayCollection();
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

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**
     * Add roles
     *
     * @param \TWM\DemoBundle\Entity\Role $roles
     * @return User
     */
    public function addRole(\TWM\DemoBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \TWM\DemoBundle\Entity\Role $roles
     */
    public function removeRole(\TWM\DemoBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {

    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * @see Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            ) = unserialize($serialized);
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreationTimeValue()
    {
        $this->creationTime = new DateTime();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setLastModificationTimeValue()
    {
        $this->lastModificationTime = new DateTime();
    }

}