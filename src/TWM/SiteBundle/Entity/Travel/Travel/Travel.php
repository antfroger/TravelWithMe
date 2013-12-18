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
     * @ORM\Column(type="date", nullable=true)
     */
    protected $startedAt;

    /**
     * @ORM\Column(type="date", nullable=true)
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
     * @ORM\Column(type="integer")
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
     * @param  string $name
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
     * @param  User   $author
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
     * @param  \TWM\SiteBundle\Entity\Travel\Travel\Theme $theme
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
     * @return Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set travellers profile
     *
     * @param  \TWM\SiteBundle\Entity\Travel\Travel\Profile $profile
     * @return Travel
     */
    public function setProfile(Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get travellers profile
     *
     * @return Profile
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
     * @param  \TWM\SiteBundle\Entity\Travel\Travel\Budget $budget
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
     * @return Budget
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set steps
     *
     * @param  \Doctrine\Common\Collections\ArrayCollection $steps
     * @return Travel
     */
    public function setSteps(ArrayCollection $steps)
    {
        $this->clearSteps();

        foreach ($steps as $step) {
            $this->addStep($step);
        }

        return $this;
    }

    /**
     * Get steps
     *
     * @return array
     */
    public function getSteps()
    {
        return $this->steps ?: $this->steps = new ArrayCollection();
    }

    /**
     * Add a step
     *
     * @param  \TWM\SiteBundle\Entity\Travel\Step\Step $step
     * @return Travel
     */
    public function addStep(Step $step)
    {
        if (!$this->getSteps()->contains($step)) {
            $step->setTravel($this);
            $this->getSteps()->add($step);
        }

        return $this;
    }

    /**
     * Remove a step
     *
     * @param  \TWM\SiteBundle\Entity\Travel\Step\Step $step
     * @return Travel
     */
    public function removeStep(Step $step)
    {
        if ($this->getSteps()->contains($step)) {
            $step->setTravel(null);
            $this->getSteps()->removeElement($step);
        }

        return $this;
    }

    /**
     * Remove all the steps
     *
     * @return Travel
     */
    public function clearSteps()
    {
        $this->getSteps()->clear();

        return $this;
    }

    /**
     * Get photos
     *
     * @return array
     */
    public function getPhotos()
    {
        return $this->photos ?: $this->photos = new ArrayCollection();
    }

    /**
     * Add a photo
     *
     * @param  \TWM\SiteBundle\Entity\Travel\Travel\Photo $photo
     * @return Travel
     */
    public function addPhoto(Photo $photo)
    {
        if (!$this->getPhotos()->contains($photo)) {
            $photo->setTravel($this);
            $this->getPhotos()->add($photo);
        }

        return $this;
    }

    /**
     * Remove a photo
     *
     * @param  \TWM\SiteBundle\Entity\Travel\Travel\Photo $photo
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
     * Remove all the photos
     *
     * @return Travel
     */
    public function clearPhotos()
    {
        $this->getPhotos()->clear();

        return $this;
    }

    /**
     * Get evaluations
     *
     * @return array
     */
    public function getEvaluations()
    {
        return $this->evaluations ?: $this->evaluations = new ArrayCollection();
    }

    /**
     * Add an evaluation
     *
     * @param \TWM\SiteBundle\Entity\Travel\Travel\Evaluation
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
     * @param \TWM\SiteBundle\Entity\Travel\Travel\Evaluation
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
        $this->startedAt  = $this->guessStartedAt();
        $this->finishedAt = $this->guessFinishedAt();
        $this->duration   = $this->guessDuration();
        $this->type       = $this->guessType();
    }

    /**
     * Guess the duration in function of the starting date and the ending date
     *
     * @return integer
     */
    private function guessDuration()
    {
        if (!$this->startedAt || !$this->finishedAt) {
            return 0;
        }

        $interval = $this->finishedAt->diff($this->startedAt);

        return (int) $interval->format('%a');
    }

    /**
     * Guess the start date in function of the start dates of the travel's steps
     *
     * @return \DateTime
     */
    private function guessStartedAt()
    {
        $startedAt = null;

        foreach ($this->getSteps() as $step) {
            if (is_null($startedAt) || $startedAt > $step->getStartedAt()) {
                $startedAt = $step->getStartedAt();
            }
        }

        return $startedAt;
    }

    /**
     * Guess the end date in function of the end dates of the travel's steps
     *
     * @return \DateTime
     */
    private function guessFinishedAt()
    {
        $finishedAt = null;

        foreach ($this->getSteps() as $step) {
            if (is_null($finishedAt) || $finishedAt < $step->getFinishedAt()) {
                $finishedAt = $step->getFinishedAt();
            }
        }

        return $finishedAt;
    }

    /**
     * Guess the type in function of the start and end dates
     *
     * @return intege
     */
    private function guessType()
    {
        if (is_null($this->startedAt) && is_null($this->finishedAt)) {
            return Type::DRAFT;
        }

        $type = null;
        $now    = new DateTime();

        if ($this->startedAt instanceof DateTime
            && is_null($this->finishedAt)
        ) {
            if ($this->startedAt <= $now) {
                $type = Type::IN_PROGRESS;
            } else {
                $type = Type::SCHEDULED;
            }
        } elseif (is_null($this->startedAt)
            && $this->finishedAt instanceof DateTime
        ) {
            if ($this->finishedAt < $now) {
                $type = Type::DONE;
            } else {
                $type = Type::IN_PROGRESS;
            }
        } elseif ($this->startedAt instanceof DateTime
            && $this->finishedAt instanceof DateTime
        ) {
            if ($now < $this->startedAt) {
                $type = Type::SCHEDULED;
            } elseif ($this->startedAt <= $now && $now <= $this->finishedAt) {
                $type = Type::IN_PROGRESS;
            } else {
                $type = Type::DONE;
            }
        }

        return $type;
    }

}
