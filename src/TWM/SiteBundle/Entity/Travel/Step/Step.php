<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Entity\Travel\Step;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use TWM\CommonBundle\Entity\Entity;
use TWM\SiteBundle\Entity\Travel\Travel\Travel;

/**
 * Represents a Step
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Step extends Entity
{

    /**
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Travel\Travel\Travel", inversedBy="steps")
     */
    protected $travel;

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
     * @ORM\ManyToOne(targetEntity="TWM\SiteBundle\Entity\Location\City")
     */
    protected $city;

    /**
     * @ORM\Column(type="integer")
     */
    protected $travelTime;

    /**
     * @todo
     */
    protected $transport;

    /**
     * @ORM\ManyToMany(targetEntity="TWM\SiteBundle\Entity\Travel\Step\Place", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="Step_Place")
     */
    protected $places;

    /**
     * @ORM\ManyToMany(targetEntity="TWM\SiteBundle\Entity\Travel\Step\Restaurant", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="Step_Restaurant")
     */
    protected $restaurants;

    /**
     * @ORM\ManyToMany(targetEntity="TWM\SiteBundle\Entity\Travel\Step\Hotel", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="Step_Hotel")
     */
    protected $hotels;

    /**
     * @ORM\OneToMany(targetEntity="TWM\SiteBundle\Entity\Travel\Step\Photo", mappedBy="step", cascade={"persist", "remove"});
     */
    protected $photos;

    public function __construct(DateTime $startedAt = null, DateTime $finishedAt = null)
    {
        $this->startedAt   = $startedAt;
        $this->finishedAt  = $finishedAt;
        $this->duration    = 0;
        $this->travel      = null;
        $this->city        = null;
        $this->travelTime  = 0;
        $this->transport   = null;
        $this->places      = new ArrayCollection();
        $this->restaurants = new ArrayCollection();
        $this->hotels      = new ArrayCollection();
        $this->photos      = new ArrayCollection();
    }

    /**
     * Set travel
     *
     * @param  Travel $travel
     * @return Step
     */
    public function setTravel(Travel $travel = null)
    {
        $this->travel = $travel;

        return $this;
    }

    /**
     * Get travel
     *
     * @return Travel
     */
    public function getTravel()
    {
        return $this->travel;
    }

    /**
     * Set startedAt
     *
     * @param  DateTime $startedAt
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
     * @param  DateTime $finishedAt
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
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->guessDuration();
    }

    /**
     * Set travelTime
     *
     * @param  integer $travelTime
     * @return Step
     */
    public function setTravelTime($travelTime)
    {
        $this->travelTime = $travelTime;

        return $this;
    }

    /**
     * Get travelTime
     *
     * @return integer
     */
    public function getTravelTime()
    {
        return $this->travelTime;
    }

    /**
     * Get places
     *
     * @return array
     */
    public function getPlaces()
    {
        return $this->places ?: $this->places = new ArrayCollection();
    }

    /**
     * Add a place
     *
     * @param TWM\SiteBundle\Entity\Travel\Step\Place
     * @return Travel
     */
    public function addPlace(Place $place)
    {
        if (!$this->getPlaces()->contains($place)) {
            $this->getPlaces()->add($place);
        }

        return $this;
    }

    /**
     * Remove a place
     *
     * @param TWM\SiteBundle\Entity\Travel\Step\Place
     * @return Travel
     */
    public function removePlace(Place $place)
    {
        if ($this->getPlaces()->contains($place)) {
            $this->getPlaces()->removeElement($place);
        }

        return $this;
    }

    /**
     * Get restaurants
     *
     * @return array
     */
    public function getRestaurants()
    {
        return $this->restaurants ? : $this->restaurants = new ArrayCollection();
    }

    /**
     * Add a restaurant
     *
     * @param TWM\SiteBundle\Entity\Travel\Step\Restaurant
     * @return Travel
     */
    public function addRestaurant(Restaurant $restaurant)
    {
        if (!$this->getRestaurants()->contains($restaurant)) {
            $this->getRestaurants()->add($restaurant);
        }

        return $this;
    }

    /**
     * Remove a restaurant
     *
     * @param TWM\SiteBundle\Entity\Travel\Step\Restaurant
     * @return Travel
     */
    public function removeRestaurant(Restaurant $restaurant)
    {
        if ($this->getRestaurants()->contains($restaurant)) {
            $this->getRestaurants()->removeElement($restaurant);
        }

        return $this;
    }

    /**
     * Get hotels
     *
     * @return array
     */
    public function getHotels()
    {
        return $this->hotels ? : $this->hotels = new ArrayCollection();
    }

    /**
     * Add a hotel
     *
     * @param TWM\SiteBundle\Entity\Travel\Step\Hotel
     * @return Travel
     */
    public function addHotel(Hotel $hotel)
    {
        if (!$this->getHotels()->contains($hotel)) {
            $this->getHotels()->add($hotel);
        }

        return $this;
    }

    /**
     * Remove a hotel
     *
     * @param TWM\SiteBundle\Entity\Travel\Step\Hotel
     * @return Travel
     */
    public function removeHotel(Hotel $hotel)
    {
        if ($this->getHotels()->contains($hotel)) {
            $this->getHotels()->removeElement($hotel);
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
        return $this->photos ? : $this->photos = new ArrayCollection();
    }

    /**
     * Add a photo
     *
     * @param TWM\SiteBundle\Entity\Travel\Step\Photo
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
     * @param TWM\SiteBundle\Entity\Travel\Step\Photo
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
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->duration = $this->guessDuration();
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

}
