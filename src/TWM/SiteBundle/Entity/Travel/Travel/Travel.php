<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Entity\Travel\Travel;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use TWM\CommonBundle\Entity\Entity;
use TWM\SiteBundle\Entity\Travel\Step\Step;
use TWM\SiteBundle\Entity\Travel\Travel\Budget;
use TWM\SiteBundle\Entity\Travel\Travel\Photo;
use TWM\SiteBundle\Entity\Travel\Travel\Theme;
use TWM\SiteBundle\Entity\Travel\Travel\Profile;
use TWM\SiteBundle\Entity\Travel\Travel\Type;
use TWM\SiteBundle\Entity\User\User;

/**
 * Represents a travel
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Travel extends Entity
{

    const DEFAULT_NAME = '';

    /**
     * @ORM\Column
     * @Assert\NotBlank
     */
    protected $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $startedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $finishedAt;

    /**
     * @ORM\Column(type="integer")
     */
    protected $duration;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\User\User", inversedBy="travels")
     */
    protected $author;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Theme", inversedBy="travels")
     */
    protected $theme;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Type", inversedBy="travels")
     */
    protected $type;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Profile", inversedBy="travels")
     */
    protected $profile;

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Budget", inversedBy="travels")
     */
    protected $budget;

    /**
     * @ORM\OneToMany(targetEntity="TWM\SiteBundle\Entity\Travel\Step\Step", mappedBy="travel", cascade={"persist", "remove"})
     */
    protected $steps;

    /**
     * @ORM\OneToMany(targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Photo", mappedBy="travel", cascade={"persist", "remove"})
     */
    protected $photos;

    /**
     * @ORM\OneToMany(targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Evaluation", mappedBy="travel", cascade={"persist", "remove"})
     */
    protected $evaluations;

    public function __construct($name = self::DEFAULT_NAME, User $author = null)
    {
        $this->name        = $name;
        $this->author      = $author;
        $this->startedAt   = null;
        $this->finishedAt  = null;
        $this->theme       = null;
        $this->type        = null;
        $this->profile     = null;
        $this->duration    = 0;
        $this->budget      = null;
        $this->steps       = new ArrayCollection();
        $this->photos      = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
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
     * Get startedAt
     *
     * @return DateTime
     */
    public function getStartedAt()
    {
        return $this->guessStartedAt();
    }

    /**
     * Get finishedAt
     *
     * @return DateTime
     */
    public function getFinishedAt()
    {
        return $this->guessFinishedAt();
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
     * @param \TWM\SiteBundle\Entity\Travel\Travel\Theme $theme
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
     * @return \TWM\SiteBundle\Entity\Travel\Travel\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set type
     *
     * @param \TWM\SiteBundle\Entity\Travel\Travel\Type $type
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
     * @return \TWM\SiteBundle\Entity\Travel\Travel\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set travellers profile
     *
     * @param \TWM\SiteBundle\Entity\Travel\Travel\Profile $profile
     * @return Travel
     */
    public function setProfile(Profile $profile = null)
    {
        $this->type = $profile;

        return $this;
    }

    /**
     * Get travellers profile
     *
     * @return \TWM\SiteBundle\Entity\Travel\Travel\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->guessDuration();
    }

    /**
     * Set budget
     *
     * @param \TWM\SiteBundle\Entity\Travel\Travel\Budget $budget
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
     * @return \TWM\SiteBundle\Entity\Travel\Travel\Budget
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Get steps
     *
     * @return array
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * Add a step
     *
     * @param TWM\SiteBundle\Entity\Travel\Step\Step $step
     * @return Travel
     */
    public function addStep(Step $step)
    {
        if (!$this->getSteps()->contains($step)) {
            $this->getSteps()->add($step);
        }

        return $this;
    }

    /**
     * Remove a step
     *
     * @param TWM\SiteBundle\Entity\Travel\Step\Step $step
     * @return Travel
     */
    public function removeStep(Step $step)
    {
        if ($this->getSteps()->contains($step)) {
            $this->getSteps()->removeElement($step);
        }

        return $this;
    }

    /**
     * Get photos
     *
     * @return array
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add a photo
     *
     * @param TWM\SiteBundle\Entity\Travel\Travel\Photo $photo
     * @return Travel
     */
    public function addPhoto(Photo $photo)
    {
        if (!$this->getPhotos()->contains($photo)) {
            $this->getPhotos()->add($photo);
        }

        return $this;
    }

    /**
     * Remove a photo
     *
     * @param TWM\SiteBundle\Entity\Travel\Travel\Photo $photo
     * @return Travel
     */
    public function removePhoto(Photo $photo)
    {
        if ($this->getPhotos()->contains($photo)) {
            $this->getPhotos()->removeElement($photo);
        }

        return $this;
    }

    /**
     * Get evaluations
     *
     * @return array
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }

    /**
     * Add an evaluation
     *
     * @param TWM\SiteBundle\Entity\Travel\Travel\Evaluation
     * @return Travel
     */
    public function addEvaluation(Evaluation $evaluation)
    {
        if (!$this->getEvaluations()->contains($evaluation)) {
            $this->getEvaluations()->add($evaluation);
        }

        return $this;
    }

    /**
     * Remove an evaluation
     *
     * @param TWM\SiteBundle\Entity\Travel\Travel\Evaluation
     * @return Travel
     */
    public function removeEvaluation(Evaluation $evaluation)
    {
        if ($this->getEvaluations()->contains($evaluation)) {
            $this->getEvaluations()->removeElement($evaluation);
        }

        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->duration   = $this->guessDuration();
        $this->startedAt  = $this->guessStartedAt();
        $this->finishedAt = $this->guessFinishedAt();
    }

    /**
     * Guess the duration in function of the starting date and the ending date
     *
     * @return int
     */
    private function guessDuration()
    {
        if (!$this->startedAt || !$this->finishedAt) {
            return 0;
        }

        $interval = $this->finishedAt->diff($this->startedAt);

        return (int) $interval->format('%a');
    }

    private function guessStartedAt()
    {
        $startedAt = null;

        foreach ($this->getSteps() as $step) {
            if ($startedAt > $step->getStartedAt()) {
                $startedAt = $step->getStartedAt();
            }
        }

        return $startedAt;
    }

    private function guessFinishedAt()
    {
        $finishedAt = null;

        foreach ($this->getSteps() as $step) {
            if ($finishedAt < $step->getFinishedAt()) {
                $finishedAt = $step->getFinishedAt();
            }
        }

        return $finishedAt;
    }

}