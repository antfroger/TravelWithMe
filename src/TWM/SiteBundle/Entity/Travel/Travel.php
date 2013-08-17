<?php

namespace TWM\SiteBundle\Entity\Travel;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use TWM\CommonBundle\Entity\Entity;
use TWM\SiteBundle\Entity\Travel\Budget;
use TWM\SiteBundle\Entity\Travel\Duration;
use TWM\SiteBundle\Entity\Travel\Theme;
use TWM\SiteBundle\Entity\Travel\TravellersProfile;
use TWM\SiteBundle\Entity\Travel\Type;
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
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Theme", inversedBy="travels")
     */
    protected $theme;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Type", inversedBy="travels")
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\TravellersProfile", inversedBy="travels")
     */
    protected $travellersProfile;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Duration", inversedBy="travels")
     */
    protected $duration;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Budget", inversedBy="travels")
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
     * @ORM\OneToMany(targetEntity="TWM\SiteBundle\Entity\Travel\Evaluation", mappedBy="travel")
     */
    protected $evaluations;

    public function __construct()
    {
        // ... FIXME ...
    }

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

    /**
     * Set theme
     *
     * @param \TWM\SiteBundle\Entity\Travel\Theme $theme
     * @return Travel
     */
    public function setTheme(Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \TWM\SiteBundle\Entity\Travel\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set type
     *
     * @param \TWM\SiteBundle\Entity\Travel\Type $type
     * @return Travel
     */
    public function setType(Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \TWM\SiteBundle\Entity\Travel\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set travellers profile
     *
     * @param \TWM\SiteBundle\Entity\Travel\TravellersProfile $travellersProfile
     * @return Travel
     */
    public function setTravellersProfile(TravellersProfile $travellersProfile = null)
    {
        $this->type = $travellersProfile;

        return $this;
    }

    /**
     * Get travellers profile
     *
     * @return \TWM\SiteBundle\Entity\Travel\TravellersProfile
     */
    public function getTravellersProfile()
    {
        return $this->travellersProfile;
    }

    /**
     * Set duration
     *
     * @param \TWM\SiteBundle\Entity\Travel\Duration $duration
     * @return Travel
     */
    public function setDuration(Duration $duration = null)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return \TWM\SiteBundle\Entity\Travel\Duration
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set budget
     *
     * @param \TWM\SiteBundle\Entity\Travel\Budget $budget
     * @return Travel
     */
    public function setBudget(Budget $budget = null)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return \TWM\SiteBundle\Entity\Travel\Budget
     */
    public function getBudget()
    {
        return $this->budget;
    }

    public function getEvaluations()
    {
        return $this->evaluations ? : $this->evaluations = new ArrayCollection();
    }

    public function addEvaluation(Evaluation $evaluation)
    {
        if (!$this->getEvaluations()->contains($evaluation)) {
            $this->getEvaluations()->add($evaluation);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation)
    {
        if ($this->getEvaluations()->contains($evaluation)) {
            $this->getEvaluations()->removeElement($evaluation);
        }

        return $this;
    }

}