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

use Doctrine\Common\Collections\ArrayCollection;
use TWM\SiteBundle\Entity\Travel\Step\Step as StepEntity;

/**
 * Step provider
 */
class Step extends \Faker\Provider\Base
{

    /**
     * Generate hydrated Step entities
     *
     * @param  integer                                      $stepCount
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function steps($stepCount)
    {
        if ($stepCount <= 0) {
            throw new \InvalidArgumentException(sprintf(
                'The "%s" parameter should be an integer > 0',
                $stepCount
            ));
        }

        $steps      = new ArrayCollection();
        $finishedAt = null;

        for ($i = 0; $i < $stepCount; ++ $i) {
            $startedAt  = !empty($finishedAt)
                ? $finishedAt
                : $this->generator->dateTimeBetween('-1500 days', 'now');

            $finishedAt = $this->generator->dateTimeAddInterval(
                $startedAt,
                'P'
                . $this->generator->numberBetween(1, 6) . 'D'
                . 'T'
                . $this->generator->numberBetween(1, 6) . 'H'
                . $this->generator->numberBetween(1, 6) . 'M'
                . $this->generator->numberBetween(1, 6) . 'S'
            );

            $step = new StepEntity($startedAt, $finishedAt);
            $step->setTravelTime($this->generator->numberBetween(1, 10));

            // FIXME handle places, restaurants, hotels

            $steps->add($step);
        }

        return $steps;
    }
}
