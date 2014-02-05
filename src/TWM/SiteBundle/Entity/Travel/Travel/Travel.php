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
use TWM\SiteBundle\Entity\Travel\Travel\Status;
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
    protected $status;

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
        $this->status      = null;
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
        if (is_null($this->startedAt)) {
            $this->startedAt = $this->guessStartedAt();
        }

        return $this->startedAt;
    }

    /**
     * Get finishedAt
     *
     * @return DateTime
     */
    public function getFinishedAt()
    {
        if (is_null($this->finishedAt)) {
            $this->finishedAt = $this->guessFinishedAt();
        }

        return $this->finishedAt;
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
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        if (is_null($this->status)) {
            $this->status = $this->guessStatus();
        }

        return $this->status;
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
        if (0 === $this->duration) {
            $this->duration = $this->guessDuration();
        }

        return $this->duration;
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

            $this->reset();
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

            $this->reset();
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
        $this->reset();

        return $this;
    }

    /**
     * Set photos
     *
     * @param  \Doctrine\Common\Collections\ArrayCollection $photos
     * @return Travel
     */
    public function setPhotos(ArrayCollection $photos)
    {
        $this->clearPhotos();

        foreach ($photos as $photo) {
            $this->addPhoto($photo);
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
     * Set evaluations
     *
     * @param  \Doctrine\Common\Collections\ArrayCollection $evaluations
     * @return Travel
     */
    public function setEvaluations(ArrayCollection $evaluations)
    {
        $this->clearEvaluations();

        foreach ($evaluations as $evaluation) {
            $this->addEvaluation($evaluation);
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
     * Remove all the evaluations
     *
     * @return Travel
     */
    public function clearEvaluations()
    {
        $this->getEvaluations()->clear();

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
        $this->status     = $this->guessStatus();
    }

    /**
     * Guess the duration in function of the starting date and the ending date
     *
     * @return integer
     */
    private function guessDuration()
    {
        if (!$this->getStartedAt() || !$this->getFinishedAt()) {
            return 0;
        }

        $interval = $this->getFinishedAt()->diff($this->getStartedAt());

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
     * Guess the status in function of the start and end dates
     *
     * @return integer
     */
    private function guessStatus()
    {
        if (is_null($this->getStartedAt())
            && is_null($this->getFinishedAt())
        ) {
            return Status::DRAFT;
        }

        $status = null;
        $now    = new DateTime();

        if ($this->getStartedAt() instanceof DateTime
            && is_null($this->getFinishedAt())
        ) {
            if ($this->getStartedAt() <= $now) {
                $status = Status::IN_PROGRESS;
            } else {
                $status = Status::SCHEDULED;
            }
        } elseif (is_null($this->getStartedAt())
            && $this->getFinishedAt() instanceof DateTime
        ) {
            if ($this->getFinishedAt() < $now) {
                $status = Status::DONE;
            } else {
                $status = Status::IN_PROGRESS;
            }
        } elseif ($this->getStartedAt() instanceof DateTime
            && $this->getFinishedAt() instanceof DateTime
        ) {
            if ($now < $this->getStartedAt()) {
                $status = Status::SCHEDULED;
            } elseif ($this->getStartedAt() <= $now
                && $now <= $this->getFinishedAt()
            ) {
                $status = Status::IN_PROGRESS;
            } else {
                $status = Status::DONE;
            }
        }

        return $status;
    }

    /**
     * Reset the properties dependant on steps
     */
    private function reset()
    {
        $this->startedAt  = null;
        $this->finishedAt = null;
        $this->duration   = 0;
        $this->status     = null;
    }
}
