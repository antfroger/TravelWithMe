<?php

namespace TWM\SiteBundle\Entity\Travel;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use TWM\CommonBundle\Entity\Entity;
use TWM\SiteBundle\Entity\User\User;

/**
 * @ORM\Entity
 */
class Travel extends Entity
{

    /**
     * @ORM\Column
     */
    protected $name;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $startedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $finishedAt;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\User\User", inversedBy="travels")
     */
    protected $author;

    /**
     */
    protected $theme;

    /**
     */
    protected $type;

    /**
     */
    protected $travellersProfile;

    /**
     */
    protected $duration;

    /**
     */
    protected $budget;

    /**
     *
     */
    protected $steps;

    /**
     *
     */
    protected $photos;

    /**
     *
     */
    protected $evaluations;


    /**
     * Set name
     *
     * @param string $name
     * @return Travel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set startedAt
     *
     * @param DateTime $startedAt
     * @return Travel
     */
    public function setStartedAt(DateTime $startedAt = null)
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * Get startedAt
     *
     * @return DateTime
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * Set finishedAt
     *
     * @param DateTime $finishedAt
     * @return Travel
     */
    public function setFinishedAt(DateTime $finishedAt = null)
    {
        $this->finishedAt = $finishedAt;

        return $this;
    }

    /**
     * Get finishedAt
     *
     * @return DateTime
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     * Set author
     *
     * @param User $author
     * @return Travel
     */
    public function setAuthor(User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }
}