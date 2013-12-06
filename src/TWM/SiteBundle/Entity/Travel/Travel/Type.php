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

/**
 * Represents a Travel Type
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 */
class Type
{

    /** @const integer */
    const DRAFT       = 1;
    /** @const integer */
    const SCHEDULED   = 2;
    /** @const integer */
    const IN_PROGRESS = 3;
    /** @const integer */
    const DONE        = 4;

    /**
     * Gets all types
     *
     * @return array
     */
    public static function getAll()
    {
        return array(
            self::DRAFT,
            self::SCHEDULED,
            self::IN_PROGRESS,
            self::DONE
        );
    }

    /**
     * Checks if the given type id valid
     *
     * @param  integer $type
     * @return boolean
     */
    public static function isValidType($type)
    {
        return in_array($type, self::getAll());
    }
}
