<?php

/**
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\DataFixtures\Provider\Travel;

use DateInterval;
use Doctrine\Common\Collections\ArrayCollection;
use Faker\Provider\Base;
use InvalidArgumentException;
use TWM\SiteBundle\Entity\Location\City;
use TWM\SiteBundle\Entity\Travel\Step\Hotel;
use TWM\SiteBundle\Entity\Travel\Step\Photo;
use TWM\SiteBundle\Entity\Travel\Step\Place;
use TWM\SiteBundle\Entity\Travel\Step\Restaurant;
use TWM\SiteBundle\Entity\Travel\Step\Step as StepEntity;

/**
 * Step provider
 */
class Step extends Base
{

    /**
     * Generate hydrated Step entities
     *
     * @param  integer         $number
     * @return ArrayCollection
     */
    public function steps($number)
    {
        $this->checkNumber($number);

        $steps      = new ArrayCollection();
        $finishedAt = null;

        for ($i = 0; $i < $number; ++ $i) {
            $startedAt  = !empty($finishedAt)
                ? $finishedAt
                : $this->generator->dateTimeBetween('-1500 days', 'now');

            $finishedAt = clone $startedAt;
            $finishedAt->add(new DateInterval(
                'P' . $this->generator->numberBetween(1, 6) . 'D'
            ));

            $city = null; // FIXME

            $step = new StepEntity($startedAt, $finishedAt);
            $step
                ->setTravelTime(
                    $this->generator->numberBetween(1, 10)
                )
                ->setPlaces(
                    $this->places(
                        mt_rand($step->getDuration(), $step->getDuration() * 3),
                        $city
                    )
                )
                ->setRestaurants(
                    $this->restaurants(
                        mt_rand(1, $step->getDuration() * 2),
                        $city
                    )
                )
                ->setHotels(
                    $this->hotels(1, $city)
                )
                ->setPhotos(
                    $this->photos(mt_rand(0, 5))
                )
            ;

            $steps->add($step);
        }

        return $steps;
    }

    /**
     * Generate Place entities
     *
     * @param  integer         $number
     * @return ArrayCollection
     */
    public function places($number, City $city = null)
    {
        $this->checkNumber($number);

        $places = new ArrayCollection();

        for ($i = 0; $i < $number; ++ $i) {
            $place = new Place($this->generator->sentence(mt_rand(1, 4)));
            $place
                ->setPrice($this->generator->text(mt_rand(50, 300)))
                ->setDescription($this->generator->paragraph(mt_rand(1, 4)))
                ->setAddress($this->generator->address)
                ->setCity($city);

            $places->add($place);
        }

        return $places;
    }

    /**
     * Generate Restaurant entities
     *
     * @param  integer         $number
     * @return ArrayCollection
     */
    public function restaurants($number, City $city = null)
    {
        $this->checkNumber($number);

        $restaurants = new ArrayCollection();

        for ($i = 0; $i < $number; ++ $i) {
            $restaurant = new Restaurant($this->generator->company);
            $restaurant
                ->setDescription($this->generator->paragraph(mt_rand(1, 4)))
                ->setAddress($this->generator->address)
                ->setCity($city);

            $restaurants->add($restaurant);
        }

        return $restaurants;
    }

    /**
     * Generate Hotel entities
     *
     * @param  integer         $number
     * @return ArrayCollection
     */
    public function hotels($number, City $city = null)
    {
        $this->checkNumber($number);

        $hotels = new ArrayCollection();

        for ($i = 0; $i < $number; ++ $i) {
            $hotel = new Hotel($this->generator->company);
            $hotel
                ->setDescription($this->generator->paragraph(mt_rand(1, 4)))
                ->setAddress($this->generator->address)
                ->setCity($city);

            $hotels->add($hotel);
        }

        return $hotels;
    }

    /**
     * Generate Hotel entities
     *
     * @param  integer         $number
     * @return ArrayCollection
     */
    public function photos($number)
    {
        $this->checkNumber($number);

        $photos = new ArrayCollection();

        for ($i = 0; $i < $number; ++ $i) {
            $photo = new Photo(
                $this->generator->image('web/' . Photo::getUploadDir(), 50, 50),
                $this->generator->optional(0.6)->word,
                $this->generator->optional(0.4)->text(mt_rand(50, 250))
            );

            $photos->add($photo);
        }

        return $photos;
    }

    /**
     * Check whether the given parameter is a number
     *
     * @param  integer                  $number
     * @throws InvalidArgumentException
     */
    private function checkNumber($number)
    {
        if (!is_int($number) || $number < 0) {
            throw new InvalidArgumentException(sprintf(
                'The "%s" parameter should be an integer >= 0',
                $number
            ));
        }
    }
}
