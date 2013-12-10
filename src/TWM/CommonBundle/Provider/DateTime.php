<?php

/**
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\CommonBundle\Provider;

use \Faker\Provider\DateTime as BaseDateTime;

class DateTime extends BaseDateTime
{

    /**
     * Get a datetime object which is added the given interval
     *
     * @param  \DateTime $date
     * @param  string    $interval
     * @return \DateTime
     */
    public static function dateTimeAddInterval(\DateTime $date, $interval)
    {
        $newDate = clone $date;
        unset($date);

        $newDate->add(new \DateInterval($interval));

        return $newDate;
    }
}
