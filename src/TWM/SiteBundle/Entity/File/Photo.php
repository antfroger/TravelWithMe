<?php

/*
 * This file is part of Travel With Me
 *
 * @copyright (c) Antoine Froger <antfroger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TWM\SiteBundle\Entity\File;

use Doctrine\ORM\Mapping as ORM;
use TWM\CommonBundle\Entity\File\File;

/**
 * Base class for Photo implementations.
 *
 * @author Antoine Froger <antfroger@gmail.com>
 *
 * @ORM\MappedSuperclass
 */
abstract class Photo extends File
{

    const DEFAULT_COMMMENT = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $comment;

    public function __construct($path = self::DEFAULT_PATH, $name = self::DEFAULT_NAME,
                                $comment = self::DEFAULT_COMMMENT)
    {
        parent::__construct($path, $name);

        $this->comment = $comment;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Photo
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

}